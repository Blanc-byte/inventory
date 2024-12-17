<?php

namespace App\Http\Controllers;

use App\Http\Controllers\console;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class equipmentController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function viewEquipment()
    {
        $equipment = collect(DB::select(" SELECT * FROM equipment "));
        $students = DB::table('students')->get();

        return view('features.equipment', [ 'equipment' => $equipment,
                                            'students' => $students]);
    }

    public function viewBorrowedEquipment()
    {
        $borrowed = collect(DB::select("SELECT b.id, s.fullname, e.name, b.quantity, b.borrowed_at
                                        FROM borrow b 
                                        JOIN students s ON b.student_id = s.id
                                        JOIN equipment e ON b.equipment_id = e.id 
                                        WHERE returned_at is null;"));

        return view('features.borrowed', [ 'borrowed' => $borrowed]);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'equipment_id' => 'required|exists:equipment,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Fetch the equipment and validate the available quantity
        $equipment = DB::table('equipment')->where('id', $validated['equipment_id'])->first();
    
        if ($validated['quantity'] > $equipment->available) {
            return back()->with('error', 'Not enough equipment available.');
        }
    
        // Insert the borrow record
        DB::table('borrow')->insert([
            'student_id' => $validated['student_id'],
            'equipment_id' => $validated['equipment_id'],
            'quantity' => $validated['quantity'],
            'borrowed_at' => now(),
        ]);
    
        // Update the available quantity in the equipment table
        DB::table('equipment')
            ->where('id', $validated['equipment_id'])
            ->decrement('available', $validated['quantity']);
    
        return back()->with('success', 'Equipment borrowed successfully.');
    }
    public function markAsReturned($id)
    {
        $updated = DB::table('borrow')
                    ->where('id', $id)
                    ->update(['returned_at' => now()]);

        return redirect()->back()->with('success', 'Successfully Returned.');
    }
    public function viewHistory()
    {
        $history = collect(DB::select("SELECT b.id, s.fullname, e.name, b.quantity, b.borrowed_at, b.returned_at
                                        FROM borrow b 
                                        JOIN students s ON b.student_id = s.id
                                        JOIN equipment e ON b.equipment_id = e.id 
                                        WHERE returned_at is not null;"));

        return view('features.history', [ 'history' => $history]);
    }
    public function viewStudents()
    {
        $students = collect(DB::select(" SELECT * FROM students"));

        return view('features.students', [ 'students' => $students]);
    }
    // Add Student Function using query builder
    public function addStudent(Request $request)
    {
        // Validate the request
        $request->validate([
            'fullname' => 'required|string|max:255',
            'year_and_section' => 'required|string|max:255',
            'department' => 'required|string|max:255',
        ]);

        // Insert student into the database using query builder
        DB::table('students')->insert([
            'fullname' => $request->fullname,
            'year_and_section' => $request->year_and_section,
            'department' => $request->department,
        ]);
        return redirect()->back()->with('success', 'Successfully Returned.');

    }

    // Update Student Function using query builder
    public function studentUpdate(Request $request, $id)
    {
        

        // Update student in the database using query builder
        DB::table('students')
            ->where('id', $id)
            ->update([
                'fullname' => $request->fullname,
                'year_and_section' => $request->year_and_section,
                'department' => $request->department,
            ]);
        return redirect()->back()->with('success', 'Successfully Returned.');
    }
    public function destroy($student)
    {
        $result = DB::table('students')->where('id', $student)->delete();

        return redirect()->back()->with('success', 'Student deleted successfully');
    }
}

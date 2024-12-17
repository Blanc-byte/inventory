<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\equipmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/equipment', [equipmentController::class, 'viewEquipment'])->middleware(['auth', 'verified'])->name('equipment');
Route::get('/borrowed', [equipmentController::class, 'viewBorrowedEquipment'])->middleware(['auth', 'verified'])->name('borrowed');
Route::get('/return/{id}', [equipmentController::class, 'markAsReturned']);
Route::get('/history', [equipmentController::class, 'viewHistory'])->middleware(['auth', 'verified'])->name('history');
Route::get('/students', [equipmentController::class, 'viewStudents'])->middleware(['auth', 'verified'])->name('students');
Route::put('/student/{id}', [equipmentController::class, 'studentUpdate'])->name('studentUpdate.update');
Route::put('/student', [equipmentController::class, 'addStudent'])->name('studentAdd.store');
Route::delete('/student/{student}', [equipmentController::class, 'destroy'])->name('student.destroy');
Route::post('/equipmentss', [equipmentController::class, 'addEquipment'])->name('equipment.add');
Route::post('/borrow', [equipmentController::class, 'store'])->name('equipment.borrow');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [equipmentController::class, 'viewEquipment'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<x-app-layout>
    <x-slot name="header">
        <h2 class="header-title">
            {{ __('History') }}
        </h2>
    </x-slot>

    <style>
        .container {
            padding: 30px;
            max-width: 1200px;
            margin: auto;
        }
        .header-title {
            font-size: 24px;
            font-weight: 600;
            color: #4A5568;
            text-align: left;
        }

        .search-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #CBD5E0;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .search-input:focus {
            outline: none;
            border-color: #5A67D8;
            box-shadow: 0 0 5px rgba(90, 103, 216, 0.5);
        }

        .table-container {
            overflow-x: auto;
            background-color: white ;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #F7FAFC;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #E2E8F0;
        }

        th {
            font-size: 14px;
            text-transform: uppercase;
            color: #718096;
        }

        td {
            font-size: 14px;
            color: #4A5568;
        }

        .equipment-row:hover {
            background-color: #EDF2F7;
        }
        .assign-button-edit3 {
            padding: 8px 16px;
            background-color: #b2e400;
            color: #000000;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 120px;
            margin-bottom: 2px;
        }

        .assign-button-edit3:hover {
            background-color: #6e8d00;
        }

        .assign-button {
            padding: 8px 16px;
            background-color: #E53E3E;
            color: #FFFFFF;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 80px;
        }

        .assign-button:hover {
            background-color: #C53030;
        }

        .assign-button-edit {
            padding: 8px 16px;
            background-color: #b2e400;
            color: #000000;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 80px;
        }

        .assign-button-edit:hover {
            background-color: #6e8d00;
        }

        .no-data {
            color: #718096;
            text-align: center;
            margin-top: 20px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 60px;
            padding-left: 10px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
        }

        .modal-header {
            font-size: 18px;
            font-weight: 600;
        }

        .modal-body input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal-footer {
            text-align: right;
        }

        .modal-button {
            padding: 10px 20px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-button:hover {
            background-color: #2563eb;
        }

        .modal-close {
            background-color: #e53e3e;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .modal-close:hover {
            background-color: #c53030;
        }
        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7); /* Darker overlay */
            justify-content: center;
            align-items: center;
            z-index: 50;
        }

        .modal-content {
            background: #9e9e9e; /* Dark modal content */
            border-radius: 0.5rem;
            padding: 2rem;
            width: 90%;
            max-width: 500px;
        }

        /* Form and Input Styles */
        input, textarea {
            background-color: #374151; /* Dark background */
            border: 1px solid #4b5563; /* Border color */
            color: #000000; /* Text color */
            padding: 0.5rem;
            width: 100%;
        }

        input:focus, textarea:focus {
            border-color: #3b82f6; /* Blue border on focus */
            outline: none;
        }

        /* Modal Buttons */
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }
    </style>

    <div class="container">
        <div class="content-box">
            <div>
                <input 
                    type="text" 
                    id="equipmentSearch" 
                    class="search-input" 
                    placeholder="Search Equipment...">
            </div>
            <button id="addStudentBtn" class="assign-button-edit3" onclick="openAddModal()">Add Student</button>
            @if(is_null($students))
                <p class="no-data">No Students found.</p>
            @else
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Year & Section</th>
                                <th>Department</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="equipmentTable">
                            @foreach($students as $student)
                                <tr class="equipment-row">
                                    <td>{{ $student->fullname }}</td>
                                    <td>{{ $student->year_and_section }}</td>
                                    <td>{{ $student->department }}</td>
                                    <td>
                                        <button class="assign-button-edit ab" onclick="openEditModal({{ $student->id }}, '{{ $student->fullname }}', '{{ $student->year_and_section }}', '{{ $student->department }}')">
                                            EDIT
                                        </button>
                                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" id="delete-form-{{ $student->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="assign-button ab" onclick="event.preventDefault(); openConfirmationModal(document.getElementById('delete-form-{{ $student->id }}'))">
                                                DELETE
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

<!-- Confirmation Modal -->
<div id="confirmation-modal" class="modal-overlay hidden">
    <div class="modal-content">
        <h2 class="text-xl font-bold mb-4">Are you sure you want to remove this Student?</h2>
        <div class="modal-buttons">
            <button type="button" onclick="closeConfirmationModal()" class="button button-red">Cancel</button>
            <button id="confirm-delete-btn" type="button" class="button button-blue">Confirm</button>
        </div>
    </div>
</div>

<!-- Edit/Add Modal -->
<div id="edit-modal" class="modal-overlay hidden">
    <div class="modal-content">
        <h2 class="text-xl font-bold mb-4" id="modal-title">Edit Student</h2>
        <form id="edit-form" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="edit-name" class="block text-sm font-bold mb-2">Name:</label>
                <input id="edit-name" name="fullname" type="text" class="w-full p-2">
            </div>
            <div class="mb-4">
                <label for="edit-description" class="block text-sm font-bold mb-2">Year & Section:</label>
                <input id="edit-description" name="year_and_section" type="text" class="w-full p-2">
            </div>
            <div class="mb-4">
                <label for="edit-price" class="block text-sm font-bold mb-2">Department:</label>
                <input id="edit-price" name="department" type="text" class="w-full p-2">
            </div>
            <div class="modal-buttons">
                <button type="button" onclick="closeEditModal()" class="button button-red">Cancel</button>
                <button type="submit" class="button button-blue">Save</button>
            </div>
        </form>
    </div>
</div>

</x-app-layout>
<script>
    let deleteForm = null;

// Open the confirmation modal and set the form for deletion
function openConfirmationModal(form) {
    deleteForm = form;
    document.getElementById('confirmation-modal').classList.remove('hidden');
    document.getElementById('confirmation-modal').style.display = 'flex';
}

// Close the confirmation modal
function closeConfirmationModal() {
    document.getElementById('confirmation-modal').classList.add('hidden');
    document.getElementById('confirmation-modal').style.display = 'none';
}

// Confirm deletion
document.getElementById('confirm-delete-btn').onclick = function() {
    if (deleteForm) {
        deleteForm.submit();
    }
    closeConfirmationModal();
}
    const editModal = document.getElementById('edit-modal');
        const editForm = document.getElementById('edit-form');
        const editName = document.getElementById('edit-name');
        const editDescription = document.getElementById('edit-description');
        const editPrice = document.getElementById('edit-price');
        const modalTitle = document.getElementById('modal-title');

        // Function to open the Add Modal
        function openAddModal() {
            modalTitle.textContent = 'Add Student'; // Change modal title to Add Product
            editForm.action = '{{ route("studentAdd.store") }}'; // Set action for adding a new product
            editName.value = '';
            editDescription.value = '';
            editPrice.value = '';
            editModal.classList.remove('hidden');
            editModal.style.display = 'flex';
        }

        // Function to open the Edit Modal with data
        function openEditModal(id, fullname, year_and_section, department) {
            modalTitle.textContent = 'Edit Product'; // Change modal title to Edit Product
            editForm.action = `{{ route('studentUpdate.update', '') }}/${id}`; // Set action for editing the product
            editName.value = fullname;
            editDescription.value = year_and_section;
            editPrice.value = department;
            editModal.classList.remove('hidden');
            editModal.style.display = 'flex';
        }

        // Function to close the Edit/Add Modal
        function closeEditModal() {
            editModal.classList.add('hidden');
            editModal.style.display = 'none';
        }

    document.getElementById('equipmentSearch').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#equipmentTable .equipment-row');

        rows.forEach(row => {
            const studentName = row.cells[0].textContent.toLowerCase();
            const equipmentName = row.cells[1].textContent.toLowerCase();
            const borrowedDated = row.cells[2].textContent.toLowerCase();

            if (studentName.includes(searchValue) || equipmentName.includes(searchValue) || borrowedDated.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

</script>

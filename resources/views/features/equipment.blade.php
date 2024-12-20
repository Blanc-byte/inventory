<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="header-title">
            {{ __('Equipments') }}
        </h2>
    </x-slot> --}}
    <div id="notification-dialog" class="notification">
        <span id="notification-message"></span>
    </div>
    
    <style>
        
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(110, 110, 110, 0.7);  
            justify-content: center;
            align-items: center;
            z-index: 50;
        }

        .modal-content {
            background: #ffffff;  
            border-radius: 0.5rem;
            padding: 2rem;
            width: 90%;
            max-width: 500px;
        }
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

        .assign-button {
            padding: 8px 16px;
            background-color: #b2e400;
            color: #000000;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .assign-button:hover {
            background-color: #6e8d00;
        }

        .assign-button3 {
            padding: 8px 16px;
            background-color: #b2e400;
            color: #000000;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .assign-button3:hover {
            background-color: #6e8d00;
        }

        .assign-button2 {
            padding: 8px 16px;
            background-color: #ff442b;
            color: #000000;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .assign-button2:hover {
            background-color: #c50505;
        }

        .no-data {
            color: #718096;
            text-align: center;
            margin-top: 20px;
        }
        .sad{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>

<div class="container">
    <div class="content-box">
        <input type="text" id="equipmentSearch" class="search-input" placeholder="Search...">
            @if(is_null($equipment))
                <p>No Equipments.</p>
            @else
            
                <div class="table-container">
                    <div class="flex justify-end mb-4">
                        <button onclick="openAddEquipmentModal()" class="button button-blue assign-button3">Add Equipment</button>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Available</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="equipmentTable">
                            @foreach($equipment as $eqp)
                                <tr class="equipment-row">
                                    <td>{{ $eqp->name }}</td>
                                    <td>{{ $eqp->quantity }}</td>
                                    <td>{{ $eqp->available }}</td>
                                    <td>
                                        <button class="assign-button" 
                                                data-id="{{ $eqp->id }}" 
                                                data-name="{{ $eqp->name }}" 
                                                data-available="{{ $eqp->available }}">
                                            BORROW
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
<div id="add-equipment-modal" class="modal-overlay hidden">
    <div class="modal-content">
        <h2 class="text-xl font-bold mb-4">Add Equipment</h2>
        <form id="add-equipment-form" action="{{ route('equipment.add') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="equipment-name" class="block text-sm font-bold mb-2">Name:</label>
                <input id="equipment-name" name="name" type="text" required class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="equipment-quantity" class="block text-sm font-bold mb-2">Quantity:</label>
                <input id="equipment-quantity" name="quantity" type="number" min="1" required class="w-full p-2 border rounded">
            </div>
            {{-- <div class="mb-4">
                <label for="equipment-available" class="block text-sm font-bold mb-2">Available:</label>
                <input id="equipment-available" name="available" type="number" min="0" required class="w-full p-2 border rounded">
            </div> --}}
            <div class="flex justify-end">
                <button type="button" onclick="closeAddEquipmentModal()" class="button button-red mr-2 btnn cancel">Cancel</button>
                <button type="submit" class="button button-blue btnn add" onclick="showNotification('Successfully Added')">Add</button>
            </div>
        </form>
    </div>
</div>
<div class="modal-overlay" id="borrowModal">
    <div class="modal-content">
        <h3>Borrow Equipment</h3>
        <form id="borrowForm" action="{{ url('/borrow') }}" method="POST">
            @csrf
            <div class="left">
                <input type="hidden" name="equipment_id" id="equipment_id">
                <input type="hidden" name="student_id" id="selected_student_id">
                <div>
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" min="1" required>
                    <small id="quantity-info" style="color: gray;">Max: 0</small>
                </div>
                <div>
                    <p class="mt-4"><strong>Selected Student:</strong> <span id="selectedStudent">None</span></p>
                </div>
                <div class="btn">
                    <button type="submit" class="assign-button" id="borrowSubmit" onclick="showNotification('Successfully Borrowed')" disabled>Confirm</button>
                    <button class="assign-button2" onclick="closeModal()">Cancel</button>
                </div>
            </div>
            <div class="right">
                <h4>Select a Student</h4>
                <input type="text" id="searchStudent" placeholder="Search student by name or ID..." style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd;">
                
                <table class="table-container" id="studentsTable">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr class="student-row">
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->fullname }}</td>
                                <td><button type="button" class="select-student" data-id="{{ $student->id }}" data-name="{{ $student->fullname }}">Select</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<script>
    const addEquipmentModal = document.getElementById('add-equipment-modal');

    function openAddEquipmentModal() {
        addEquipmentModal.classList.remove('hidden');
        addEquipmentModal.style.display = 'flex';
    }

    function closeAddEquipmentModal() {
        addEquipmentModal.classList.add('hidden');
        addEquipmentModal.style.display = 'none';
    }
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('borrowModal');
        const equipmentInput = document.getElementById('equipment_id');
        const quantityInput = document.getElementById('quantity');
        const quantityInfo = document.getElementById('quantity-info');
        const searchStudent = document.getElementById('searchStudent');
        const studentsTable = document.getElementById('studentsTable');
        const selectedStudent = document.getElementById('selectedStudent');
        const selectedStudentIdInput = document.getElementById('selected_student_id');
        const borrowSubmit = document.getElementById('borrowSubmit');
        const assignButtons = document.querySelectorAll('.assign-button');
        const equipmentSearch = document.getElementById('equipmentSearch');
        const equipmentTable = document.getElementById('equipmentTable');
 
        assignButtons.forEach(button => {
            button.addEventListener('click', () => {
                const equipmentId = button.getAttribute('data-id');
                const availableQty = button.getAttribute('data-available');

                equipmentInput.value = equipmentId;
                quantityInput.max = availableQty;
                quantityInfo.textContent = `Max: ${availableQty}`;

                modal.style.display = 'flex'; 
            });
        });
 
        searchStudent.addEventListener('input', () => {
            const filter = searchStudent.value.toLowerCase();
            const rows = studentsTable.querySelectorAll('.student-row');

            rows.forEach(row => {
                const studentId = row.cells[0].textContent.toLowerCase();
                const studentName = row.cells[1].textContent.toLowerCase();

                if (studentId.includes(filter) || studentName.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
 
        equipmentSearch.addEventListener('input', () => {
            const filter = equipmentSearch.value.toLowerCase();
            const rows = equipmentTable.querySelectorAll('.equipment-row');

            rows.forEach(row => {
                const equipmentName = row.cells[0].textContent.toLowerCase();

                if (equipmentName.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
 
        studentsTable.addEventListener('click', (event) => {
            if (event.target.classList.contains('select-student')) {
                const studentId = event.target.getAttribute('data-id');
                const studentName = event.target.getAttribute('data-name');

                selectedStudent.textContent = studentName;
                selectedStudentIdInput.value = studentId;
                borrowSubmit.disabled = false;  
                
            }
        });
 
        window.closeModal = function () {
            modal.style.display = 'none';
            selectedStudent.textContent = 'None';
            selectedStudentIdInput.value = '';
            borrowSubmit.disabled = true;  
        };
    });
    function showNotification(message) {
        const notificationDialog = document.getElementById('notification-dialog');
        const notificationMessage = document.getElementById('notification-message');
        
        // Set the message text
        notificationMessage.textContent = message;

        // Show the notification
        notificationDialog.classList.add('show');

        // Hide the notification after 2 seconds
        setTimeout(() => {
            notificationDialog.classList.remove('show');
        }, 5000);
    }
</script>

<style>
    .btnn{
        padding: 5px 10px;
        width: 100px;
        border-radius: 10px;
    }
    .cancel{
        background-color: #dd0000;
    }
    .add{
        background-color: #6e8d00;
    }
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .modal-content {
        background: #fff;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 500px;
    }

    .hidden {
            display: none;
        }
    .notification {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%) translateY(-20px);
        background-color: hsl(180, 100%, 50%) ;
        color: black;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0px 4px 8px black (218, 217, 217, 0.2);
        opacity: 0; /* Starts as invisible */
        visibility: hidden; /* Ensure it's not interactable when hidden */
        z-index: 1000;
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .notification.show {
        opacity: 1; 
        visibility: visible;
        transform: translateX(-50%) translateY(10px); /* Small movement */
    }
    .btn{
        display: flex;
        justify-content: space-around;
        gap: 10px;
    }
    #borrowForm{
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }
    .left{
        background: #ffffff;  
        border-radius: 0.5rem;
        padding: 1rem;
        width: 50%;
        max-width: 1000px;
        max-height: 75vh;  
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .right{
        background: #ffffff; 
        border-radius: 0.5rem;
        padding: 1rem;
        width: 50%;
        max-width: 1000px;
        max-height: 75vh;  
        overflow-y: auto; 
    }
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(110, 110, 110, 0.7);  
        justify-content: center;
        align-items: center;
        z-index: 50;
    }

    .modal-content {
        background: #ffffff; 
        border-radius: 0.5rem;
        padding: 2rem;
        width: 90%;
        max-width: 1000px;
        max-height: 85vh; 
    }

    #searchStudent {
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #studentsTable th, #studentsTable td {
        text-align: left;
    }

    .select-student {
        background-color: #28a745;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .select-student:hover {
        background-color: #218838;
    }

    .modal-content h4 {
        margin-top: 1rem;
    }

    .modal-content input, .modal-content button {
        margin-bottom: 1rem;
    }
</style>


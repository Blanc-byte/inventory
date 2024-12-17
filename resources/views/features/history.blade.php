<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="header-title">
            {{ __('History') }}
        </h2>
    </x-slot> --}}

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

        .assign-button {
            padding: 8px 16px;
            background-color: #E53E3E;
            color: #FFFFFF;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .assign-button:hover {
            background-color: #C53030;
        }

        .no-data {
            color: #718096;
            text-align: center;
            margin-top: 20px;
        }
    </style>

    <div class="container">
        <div class="content-box">
            <div>
                {{-- Equipment Search --}}
                <input 
                    type="text" 
                    id="equipmentSearch" 
                    class="search-input" 
                    placeholder="Search...">
            </div>

            @if(is_null($history))
                <p class="no-data">No History Borrowed found.</p>
            @else
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Equipment</th>
                                <th>Quantity</th>
                                <th>Borrowed Date</th>
                                <th>Returned Date</th>
                            </tr>
                        </thead>
                        <tbody id="equipmentTable">
                            @foreach($history as $borrow)
                                <tr class="equipment-row">
                                    <td>{{ $borrow->fullname }}</td>
                                    <td>{{ $borrow->name }}</td>
                                    <td>{{ $borrow->quantity }}</td>
                                    <td>{{ $borrow->borrowed_at }}</td>
                                    <td>{{ $borrow->returned_at }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
<script>
    document.getElementById('equipmentSearch').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#equipmentTable .equipment-row');

        rows.forEach(row => {
            const studentName = row.cells[0].textContent.toLowerCase();
            const equipmentName = row.cells[1].textContent.toLowerCase();
            const borrowedDated = row.cells[2].textContent.toLowerCase();
            const returnedDated = row.cells[3].textContent.toLowerCase();

            if (studentName.includes(searchValue) || equipmentName.includes(searchValue) || borrowedDated.includes(searchValue) || returnedDated.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

</script>

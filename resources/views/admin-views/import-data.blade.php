@extends('admin-components.admin-layout')

@section('content')

<div class="container">
    <form action="{{ route('admin.import.data.execute') }}" method="POST" enctype="multipart/form-data" class="mt-4" id="importForm">
        @csrf
        <label for="csv_file" class="form-label fs-5 fw-bold">Choose a CSV file: </label>
        <div class="mb-3 d-flex">
            <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" style="width: 50%; min-width: 300px;" onchange="previewCSV(event)" required>
            <button type="button" class="btn btn-primary" id="importingData" style="margin-left: 15px;">Import</button>
        </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <div class="table-responsive border m-3 rounded">
        <table class="table admin-table table-striped table-hover" id="csvTable">
            <thead style="border-bottom: 2px solid black">
                <tr>
                    <th>Email</th>
                    <th>Unit_ID</th>
                    <th>First_Name</th>
                    <th>Middle_Name</th>
                    <th>Last_Name</th>
                    <th>Contact_No.</th>
                    <th>Address</th>
                    <th>Date_of_Birth</th>
                    <th>Tin</th>
                    <th>Position</th>
                    <th>Employee_No.</th>
                    <th>BU_Appointment_Date</th>
                    <th>Place_of_Birth</th>
                    <th>Civil_Status</th>
                    <th>Spouse</th>
                    <th>Sex</th>
                    <th>Salary</th>
                    <th>Contribution</th>
                    <th>Appointment_Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="19" style="text-align: center;">No Data</td>
                </tr>
            </tbody>

        </table>

    </div>

    <script>

        $(document).ready(function() {
            $('#importingData').click(function() {
                var $btn = $(this);
                $btn.prop('disabled', true);
                $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Importing...');

                // Submit the form
                $('#importForm').submit();
            });
        });

        function previewCSV(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const csv = e.target.result;
                const rows = csv.split('\n').slice(1); // Exclude the first row (header)

                let previewHTML = '';

                rows.forEach(row => {
                    const columns = row.split(',');

                    previewHTML += '<tr>';
                    columns.forEach(column => {
                        previewHTML += `<td>${column}</td>`;
                    });
                    previewHTML += '</tr>';
                });

                document.getElementById('csvTable').getElementsByTagName('tbody')[0].innerHTML = previewHTML;
            };

            reader.readAsText(file);
        }
    </script>
</div>


@endsection

@extends('admin-components.admin-layout')

@section('content')

<div class="container">
    <h1 class="fs-3 fw-bold" style="color: #00638D;">Remittance Batch Payment</h1>
    <form action="{{ route('admin.import.csv.payment') }}" method="POST" enctype="multipart/form-data" class="mt-4" onsubmit="return handleFormSubmission(this);">
        @csrf
        <label for="csv_file" class="form-label fs-6 fw-bold">Choose a CSV file: </label>
        <div class="mb-3 d-flex">
            <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" style="width: 50%; min-width: 300px;" onchange="previewCSV(event)" required>
            <button type="submit" class="btn btn-primary" id="importButton" style="margin-left: 15px;">Import</button>
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


    <div class="table-responsive border rounded">
        <table class="table admin-table table-striped table-hover" id="csvTable">
            <thead style="border-bottom: 2px solid black">
                <tr>
                    <th>OR Number</th>
                    <th>Loan ID</th>
                    <th>Principal</th>
                    <th>Interest</th>
                    <th>Payment Date</th>
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

        function handleFormSubmission(form) {
            document.getElementById('importButton').setAttribute('disabled', true);
            return true; // Submit the form
        }
    </script>
</div>


@endsection

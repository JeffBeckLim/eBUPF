@extends('admin-components.admin-layout')

@section('content')

<div class="container m-2">
    <div class="adminbox">
    <div class="row">
        <div class="col-8">
            <h5 class="fs-4 fw-bold text-dark">Batch Payment</h5>
        </div>
        <div class="col-4 text-end">
            <a href="{{ asset('storage/csv/batchPaymentFormat.csv') }}" id="downloadButton" download="Batch Payment - Format.csv" class="btn btn-primary"><i class="bi bi-download"></i> Download CSV Format</a>
        </div>
    </div>

    <form action="{{ route('admin.import.csv.payment') }}" method="POST" enctype="multipart/form-data" class="mt-4" onsubmit="return handleFormSubmission(this);">
        @csrf
        <label for="csv_file" class="form-label fs-6 fw-bold">Choose a CSV file: </label>
        <div class="mb-3 d-flex">
            <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" style="width: 50%; min-width: 300px;" onchange="previewCSV(event)" required>
            <button type="submit" class="btn btn-primary" id="importButton" style="margin-left: 15px;">Import</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive border rounded">
        <table class="table admin-table table-striped table-hover" id="csvTable">
            <thead style="border-bottom: 2px solid black">
                <tr>
                    <th>No.</th>
                    <th>OR Number</th>
                    <th>Loan ID</th>
                    <th>Principal</th>
                    <th>Interest</th>
                    <th>Payment Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" style="text-align: center;">No Data</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="warningModalLabel">Warning!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Please do not remove or change the header in the CSV file.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="{{ asset('storage/csv/BatchPayment_Format.csv') }}" download="Batch Payment - Format.csv" class="btn btn-primary">Proceed with Download</a>
                </div>
            </div>
        </div>
    </div>
    <script>
         document.getElementById('downloadButton').addEventListener('click', function(event) {
            event.preventDefault();

            var myModal = new bootstrap.Modal(document.getElementById('warningModal'));
            myModal.show();

            document.getElementById('downloadLink').addEventListener('click', function() {
                myModal.hide();
            });
        });

        function previewCSV(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const csv = e.target.result;
                const rows = csv.split('\n').slice(1);
                // Exclude the first row (header)

                let previewHTML = '';

                if (rows.length === 0) {
                    // Show 'No Data' placeholder if there are no rows in the CSV
                    document.querySelector('#csvTable tbody tr').style.display = 'table-row';
                } else {
                    rows.forEach((row, index) => {
                        const columns = row.split(',');

                        previewHTML += '<tr>';
                        previewHTML += `<td>${index + 1}</td>`; // Incrementing index to display the row number
                        columns.forEach(column => {
                            previewHTML += `<td>${column}</td>`;
                        });
                        previewHTML += '</tr>';
                    });

                    document.querySelector('#csvTable tbody').innerHTML = previewHTML;
                }
            };

            reader.readAsText(file);
        }

        function handleFormSubmission(form) {
            document.getElementById('importButton').setAttribute('disabled', true);
            return true; // Submit the form
        }

        $.ajax({
            success: function(response) {
                // No success handler needed
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var error = JSON.parse(xhr.responseText).error;
                    // Display the error message
                    alert(error);
                }
            }
        });
    </script>
</div>
</div>

@endsection

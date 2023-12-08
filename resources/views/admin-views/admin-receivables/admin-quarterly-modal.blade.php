<div class="modal fade" id="downloadReportModal" tabindex="-1" aria-labelledby="downloadReportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadReportModalLabel">Filter a Report to Download</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="downloadForm" method="GET" action="{{ route('generate.receivables.quarterly.report', ['loan_type' => $loan_type]) }}">
                    @csrf
                    <div class="row mx-3 mt-3">
                        <div class="col-12">
                            <label class="fw-bold fs-6" for="unit_id">College/Unit & Campus</label>
                            <select name="unitSelect" class="form-select form-control">
                                <option value="All" {{ $selectedUnit == 'All' ? 'selected' : '' }}>Choose Unit</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->unit_code }}" {{ $selectedUnit == $unit->unit_code ? 'selected' : '' }}>
                                        {{ $unit->unit_code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-2">
                            <label class="fw-bold fs-6" for="unit_id">Year</label>
                            <select name="yearSelect" class="form-select form-control">
                                @if($distinctYears == null)
                                    <option value="" selected>No Data</option>
                                @else
                                    <option class="text-secondary" value="" selected disabled>Choose Year</option>
                                    @foreach ($distinctYears as $year)
                                        <option value="{{ $year }}"{{ $year == $selectedYear ? ' selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="my-4 mx-4">
                        <div class="text-end">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn bu-orange text-light" id="downloadButton" disabled>Download</button>
                        </div>
                    </div>

                  </form>
                </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var downloadForm = document.getElementById('downloadForm');
        var downloadButton = document.getElementById('downloadButton');

        // Function to check if either "College/Unit & Campus" or "Year" is not selected
        function checkInputs() {
            var unitSelect = downloadForm.elements['unitSelect'];
            var yearSelect = downloadForm.elements['yearSelect'];

            // Enable the button only if both inputs have selected values
            downloadButton.disabled = !(unitSelect.value && yearSelect.value);
        }

        // Add event listeners for input changes
        downloadForm.addEventListener('change', checkInputs);

        // Call the function initially to set the initial state of the button
        checkInputs();
    });


</script>

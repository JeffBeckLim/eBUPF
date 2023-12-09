@extends('member-components.member-layout')

@section('content')

    <div class="bg-white rounded px-3 pt-2 pb-4 mt-3 ms-2 border">
        <h6 class="fs-5 text-center fw-bold p-3">Loan Calculator</h6>
        
        <div class="row mx-lg-4 mx-2" style="font-size: 12px">
            Choose loan type, enter your principal amount, and loan term to calculate your monthly amortization. Get clear and quick insights into your payments.
         </div>
        <div class="row gap-md-5 mx-lg-4 mx-1 mt-3">

            <div class="col-md-4 bg-white rounded-3 border px-2 pt-2 pb-3 mb-2 shadow-sm ">
                <form action="{{route('calculate')}}" method="post">
                    @csrf
                    <div style="padding: 10px 10px 0 10px;">
                        <span class="fw-bold fs-6">Loan Category </span><span class="text-danger fw-bold">*</span> <br>
                        <div>
                            <span style="font-size: 12px" class="text-secondary">Multi-purpose (MPL) or Housing (HsL) loan</span>
                            <div class="row d-flex align-items-center">
                                <div class="col-6">
                                    {{-- <input type="radio" id="mpl" name="loan_category" value="mpl" required>
                                    <label for="mpl" class="fs-7">Multi-Purpose</label> --}}
                                    <input type="radio" class="btn-check" name="loan_category" id="option1" autocomplete="off" value="mpl" checked>
                                    <label class="btn btn-outline-dark w-100" for="option1">MPL <span style="font-size: 10px">6% INT.</span></label>
                                </div>
                                <div class="col-6">
                                    {{-- <input type="radio" id="hsl" name="loan_category" value="hsl">
                                    <label for="hsl" class="fs-7">Housing</label> --}}
                                    <input type="radio" class="btn-check" name="loan_category" id="option2" autocomplete="off" value="hsl">
                                    <label class="btn btn-outline-dark w-100" for="option2">HsL <span style="font-size: 10px">9% INT.</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 pt-2">
                            <div class="col-md-8">

                                <label for="amount" class="fw-bold">Amount <span class="text-danger fw-bold">*</span></label>
                                <h6 style="font-size: 12px" class="text-secondary">Loan Amount (min: 50k)</h6>
                                <div class="d-flex align-items-center">
                                    <input type="number"   name="amount" id="amount" class="form-control" placeholder="Enter Amount" min="50000" max="200000" required>
                                    {{-- <span style="margin-left: 5px;">
                                        <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="The principal amount you want to calculate"></i>
                                    </span> --}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="term" class="fw-bold">Year/s <span class="text-danger fw-bold">*</span></label>

                                <h6 style="font-size: 12px" class="text-secondary">Loan Term</h6>
                                <select name="term" id="term" class="form-control" required>
                                    <option value="" disabled selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2 pt-2">
                            <label for="prevLoan" class="fw-bold fs-6">Add Previous Loan</label>
                            <h6 style="font-size: 12px">Loan balance from a currently active loan</h6>
                            <input type="number" name="prevLoan" id="prevLoan" class="form-control" placeholder="Enter previous loan">
                        </div>
                        <div class="d-flex justify-content-end mt-3 pt-2">
                            <button type="reset" class="btn btn-outline-secondary me-2 rounded-2">Clear</button>
                            <button type="submit" class="btn bu-orange text-light" style="background: #FF6F19; border: none;">Calculate</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-7 bg-white rounded-3 border bg-white px-2 pt-2 pb-2 mb-2 shadow-sm">
                <div style="padding: 10px 10px 0 10px;">
                    <div class="fw-bold fs-6">
                        Result
                    </div>
                    <div class="row">

                        <div class="col-md-7">
                            <div class="row mt-3">
                                <div class="col-7 fs-7">
                                    Loan Category
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    {{ isset($loanCategory)? strtoupper($loanCategory) : '' }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-7 fs-7">
                                    Loan Amount
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    {{ number_format($amount ?? '0.00', 2, '.', ',') }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-7 fs-7">
                                    Monthly Principal
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    {{ number_format($monthlyPrincipalAmort ?? '0.00', 2, '.', ',') }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-7 fs-7">
                                    Interest
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    {{ number_format($totalInterest ?? '0.00', 2, '.', ',') }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-7 fs-7">
                                    Monthly Interest
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    {{ number_format($monthlyInterestAmort ?? '0.00', 2, '.', ',') }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-7 fs-7">
                                    Monthly Payable
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    {{ number_format($monthlyAmort ?? '0.00', 2, '.', ',') }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-7 fs-7">
                                    Total Amount
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    {{ number_format($totalAmount ?? '0.00', 2, '.', ',') }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-7 fs-7">
                                    Total Months
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    {{$totalMonths ?? '0'}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <canvas id="myPieChart" style="max-height: 225px; max-width: 225px; height: 225px; margin: 0 auto;"></canvas>
                        </div>
                        <div class="pt-2">
                                <a href="#" class="btn d-flex justify-content-center align-items-center fs-7 text-white"
                                    @if ($totalMonths == 0)
                                        disabled
                                        style="pointer-events: none; opacity: 0.6;"
                                    @else
                                        onclick="toggleTableVisibility(); return false;"
                                    @endif
                                >
                                    <span style="border-radius: 10px;background: #0092D1; padding: 8px 15px;">View Amortization Table</span>
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="amortizationTable" style="display: none;">
            <div class="d-flex justify-content-center mt-3">
                <div class="bg-white rounded-3 border bg-white px-2 pt-2 pb-2 mb-2 shadow-sm" style="width: 90%;">
                    <div class="table-container border rounded-3">
                        <table class="table fixed-width-table pl-table">
                            <thead>
                                <tr class="pl-tr" style="border-bottom: 1px solid black">
                                    <th>Month</th>
                                    <th>Beginning Balance</th>
                                    <th>Principal</th>
                                    <th>Interest</th>
                                    <th>Ending Balance</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @if ($totalMonths != 0)
                                    @php
                                        $yearlyBalancesCount = count($yearlyBalances);
                                    @endphp
                                    @for ($i = 0; $i < $totalMonths; $i++)
                                        <tr class="pl-tr">
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ number_format($beginningBalance[$i] ?? '0.00', 2, '.', ',') }}</td>
                                            <td>{{ number_format($monthlyPrincipalAmort ?? '0.00', 2, '.', ',') }}</td>
                                            <td>{{ number_format($monthlyInterestAmort ?? '0.00', 2, '.', ',') }}</td>
                                            <td>{{ number_format($endingBalance[$i] ?? '0.00', 2, '.', ',') }}</td>
                                        </tr>


                                        @if (($i + 1) % 12 === 0)
                                            @php
                                                $yearly = ($i + 1) / 12;
                                                $yearlyIndex = $yearlyBalancesCount - $yearly;
                                            @endphp
                                            <tr class="pl-tr" style="background-color: #f2f2f2;"> <!-- Add background color to yearly total row -->
                                                <td colspan="2" class="text-start" style="padding-left: 30px;">Year {{ $yearly }} total</td>
                                                <td class="fw-bold text-danger">{{ number_format($yearlyBalances[$yearlyIndex]['yearlyBalance'] ?? '0.00', 2, '.', ',') }}</td>
                                                <td class="fw-bold text-danger">{{ number_format($yearlyBalances[$yearlyIndex]['yearlyInterest'] ?? '0.00', 2, '.', ',') }}</td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endfor
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4">
            <div class="fw-bold fs-6">
                Loan Categories
            </div>
            <div class="fs-7 mt-2" style="margin-left: 25px;">
                <span class="fw-bold" style="color: orange">Multi-Purpose Loan </span> 6% interest - Unrestricted funds for various personal needs, with no specified purpose. Typically unsecured, based on creditworthiness.
            </div>
            <div class="fs-7 mt-2" style="margin-left: 25px;">
                <span class="fw-bold" style="color: rgb(65, 160, 198)">Housing Loan </span> 9% interest -  Exclusive financing for housing-related expenses like buying or renovating a home. Secured by the property, with competitive interest rates.
            </div>
            <div class="fs-7 mt-2">
                <span class="fw-bold">Monthly Principal and Monthly Interest</span> The monthly principal refers to the portion of a loan payment that goes towards repaying the original amount borrowed. Monthly interest represents the cost of borrowing for a specific period. In a loan payment, it is the portion allocated to compensating the lender for providing the funds.
            </div>
            <div class="fs-7 mt-2">
                <span class="fw-bold">Monthly Payable</span> =  Monthly Principal + Monthly Intrest
            </div>
            <div class="fs-7 mt-2">
                <span class="fw-bold">Total Amount</span> = Monthly payable * Loan term - refers to the overall sum that a borrower will repay over the entire duration of the loan. It includes both the original amount borrowed (the principal) and the interest accrued during the repayment period.
            </div>
            <div class="fs-7 mt-2">
                <span class="fw-bold">Total Months</span> - Months in the loan term (Loan Term Years * 12).
            </div>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Loan Amount', 'Interest'],
                datasets: [{
                    data: [{{ $amount ?? "0"}}, {{ $totalInterest ?? "0" }}],
                    backgroundColor: ['#FF6F19', '#36A2EB'],
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        color: '#fff',
                        formatter: function(value, context) {
                            var dataset = context.chart.data.datasets[0];
                            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                                return previousValue + currentValue;
                            });
                            var percentage = Math.round((value / total) * 100);
                            return percentage + '%';
                        },
                        position: 'right',
                    },
                },
                legend: {
                    display: false,
                },
            },
        });

        function toggleTableVisibility() {
            var table = document.getElementById('amortizationTable');
            if (table.style.display === 'none') {
                table.style.display = 'block';
            } else {
                table.style.display = 'none';
            }
        }
    </script>

@endsection

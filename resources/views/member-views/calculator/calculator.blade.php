@extends('member-components.member-layout')

@section('content')

    <div class="bg-white rounded px-3 pt-2 pb-4 m-3 shadow-sm">
        <div class="d-flex align-items-center p-3 gap-3">
            <img src="{{asset('icons/calculator.svg')}}" alt="calculator logo" width="30px" height="50px">
            <span style="font-size: 20px; font-weight: bold; color: #000834;">Loan Calculator</span>
        </div>
        <div style="margin-left: 100px; margin-top: -15px; font-size: 0.9rem;">
           proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit
        </div>
        <div class="row gap-md-5 mx-4 mt-3">
            <div class="col-md-4 bg-white rounded-3 border bg-white px-2 pt-2 pb-2 mb-2 shadow-sm">
                <form action="{{route('calculate')}}" method="post">
                    @csrf
                    <div style="padding: 10px 10px 0 10px;">
                        <span class="fw-bold fs-6">Loan Category </span><span class="text-danger fw-bold">*</span> <br>
                        <div style="padding: 5px 0 0 13px;">
                            <div class="row pt-1">
                                <div class="col-lg-6">
                                    <input type="radio" id="mpl" name="loan_category" value="mpl" required>
                                    <label for="mpl" class="fs-7">Multi-Purpose</label>
                                </div>
                                <div class="col-lg-5">
                                    <input type="radio" id="hsl" name="loan_category" value="hsl">
                                    <label for="hsl" class="fs-7">Housing</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 pt-2">
                            <div class="col-md-8">
                                <label for="amount" class="fw-bold">Amount <span class="text-danger fw-bold">*</span></label>
                                <div class="d-flex align-items-center">
                                    <input type="number"  name="amount" id="amount" class="form-control" placeholder="Enter Amount" min="1" max="200000" required>
                                    <span style="margin-left: 5px;">
                                        <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="The principal amount you want to calculate"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="term" class="fw-bold">Year/s <span class="text-danger fw-bold">*</span></label>
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
                                    Loan Amount
                                </div>
                                <div class="col-5 fs-7 fw-bold">
                                    {{ number_format($amount ?? '0.00', 2, '.', ',') }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-7 fs-7">
                                    Monthly principal
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
                            <canvas id="myPieChart" style="max-width: 225px; height: 225px; margin: 0 auto;"></canvas>
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
                <span class="fw-bold">Multi-Purpose Loan </span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ipsum suspendisse ultrices gravida dictum fusce ut.
            </div>
            <div class="fs-7 mt-2" style="margin-left: 25px;">
                <span class="fw-bold">Housing Loan </span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ipsum suspendisse ultrices gravida dictum fusce ut.
            </div>
            <div class="fs-7 mt-2">
                <span class="fw-bold">Monthly Principal and Monthly Interest</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ipsum suspendisse ultrices gravida dictum fusce ut.
            </div>
            <div class="fs-7 mt-2">
                <span class="fw-bold">Monthly Payable</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ipsum suspendisse ultrices gravida dictum fusce ut.
            </div>
            <div class="fs-7 mt-2">
                <span class="fw-bold">Total Amount</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ipsum suspendisse ultrices gravida dictum fusce ut.
            </div>
            <div class="fs-7 mt-2">
                <span class="fw-bold">Total Months</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ipsum suspendisse ultrices gravida dictum fusce ut.
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

@php
    $dateString = $loan->amortization->amort_start;
    $date = \Carbon\Carbon::parse($dateString);

    $oneMonthAgo = $date->subMonth();

    $amort_start = \Carbon\Carbon::parse($loan->amortization->amort_start);
    $amort_end = \Carbon\Carbon::parse($loan->amortization->amort_end);

    $carbonStartDate = Carbon\Carbon::parse($loan->amortization->amort_start);
    $carbonEndDate = Carbon\Carbon::parse($loan->amortization->amort_end);

    $amortStartSubMonth = Carbon\Carbon::parse($carbonStartDate->subMonth());
    $monthsDifference = $carbonStartDate->diffInMonths($carbonEndDate);


    $latestPayment = Carbon\Carbon::parse($latest_payment->payment_date);
    $monthsDifferencePayment = $monthsDifference - $latestPayment->diffInMonths($carbonEndDate);

@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid rgb(130, 130, 130);
        }

        th, td {
            text-align: left;
            padding: 5px;
        }

        .to-bold{
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div>
        <div style="width: 100%; text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 5px;">{{ $member->lastname }}, {{ $member->firstname }}</div>
        @if($loan->loanType->loan_type_name == 'MPL')
            <div style="width: 100%; text-align: center; font-weight: normal; font-size: 13px; margin-bottom: 15px;">Multi-Purpose Loan {{-- {{ $loan->id }} --}}</div>
        @elseif($loan->loanType->loan_type_name == 'HSL')
            <div style="width: 100%; text-align: center; font-weight: normal; font-size: 13px; margin-bottom: 15px;">Housing Loan {{-- {{ $loan->id }} --}}</div>
        @endif
    </div>
    <table>
        <thead>
            <tr>
                <th colspan="2" style="text-align: center;">LOAN DETAILS</th>
                <th colspan="2" style="text-align: center;">OTHER DETAILS</th>
                <th colspan="2" style="text-align: center;">PAYMENT DETAILS</th>
                <th colspan="2" style="text-align: center;">OTHER PAYMENT DETAILS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="to-bold">Principal:</td>
                <td>{{number_format($loan->principal_amount, 2, '.', ',')}}</td>
                <td class="to-bold">Loan Grant:</td>
                <td>{{ $oneMonthAgo->format('M Y') }}</td>
                <td class="to-bold">Principal Paid: </td>
                <td>{{number_format($principal_paid, 2, '.', ',')}}</td>
                <td class="to-bold">Principal Bal.:</td>
                <td>{{number_format($loan->principal_amount - $principal_paid, 2, '.', ',')}}</td>
            </tr>
            <tr>
                <td class="to-bold">Interest: </td>
                <td>{{number_format($loan->interest, 2, '.', ',')}}</td>
                <td class="to-bold">Amort. Period:</td>
                <td>{{$amort_start->format('M Y')}} | {{$amort_end->format('M Y')}}</td>
                <td class="to-bold">Interest Paid:</td>
                <td>{{number_format($interest_paid, 2, '.', ',')}}</td>
                <td class="to-bold">Interest Bal.:</td>
                <td>{{
                    number_format(
                  ($loan->interest - $interest_paid)
                  , 2, '.', ',')
                }}</td>
            </tr>
            <tr>
                <td class="to-bold">Monthly Amort. Prin.:</td>
                <td>{{number_format($loan->amortization->amort_principal, 2, '.', ',')}}</td>
                <td class="to-bold">Term (Year):</td>
                <td>{{$loan->term_years}}</td>
                <td class="to-bold">Total paid: </td>
                <td>{{number_format($interest_paid + $principal_paid, 2, '.', ',')}}</td>
                <td class="to-bold">Total Bal.:</td>
                <td>
                    {{
                    number_format(
                  ($loan->interest - $interest_paid)  +
                  ($loan->principal_amount - $principal_paid)
                  , 2, '.', ',')
                }}
                </td>
            </tr>
            <tr>
                <td class="to-bold">Monthly Interest:</td>
                <td>{{number_format($loan->amortization->amort_interest, 2, '.', ',')}}</td>
                <td class="to-bold">Term (Month):</td>
                <td>{{$monthsDifference}}</td>
                <td class="to-bold">Months Paid:</td>
                <td>
                    @if ($latest_payment != null)
                        {{$monthsDifferencePayment}}
                    @endif
                </td>
                <td class="to-bold">Months Left:</td>
                <td>
                    @if ($latest_payment != null)
                        {{$monthsDifferencePayment = $latestPayment->diffInMonths($carbonEndDate)}}
                    @else
                        {{$monthsDifference}}
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
            <div style="margin-top: 20px;">
                <table>
                    <thead>
                        <tr>
                            <th>
                                @if($loan->loanCategory)
                                    <span style="color: #a01a1a; letter-spacing: 2px">{{strtoupper($loan->loanCategory->loan_category_name)}}</span>
                                @else
                                    <div style="font-size: 12px">Loan type: <br>not specified.</div>
                                @endif


                            </th>

                            @php
                                $recordStart = $amort_start->copy()->subMonth()->format('Y');
                                $recordEnd = $amort_end->format('Y');
                            @endphp

                            @for ($x = $recordEnd; $x >= $recordStart; $x--)
                                <th colspan="2" style="text-align: center;">{{{$x}}}</th>
                            @endfor
                        </tr>
                        <tr style="border-bottom: 1px solid black">
                            <th>Month</th>
                            @for ( $i=-1; $i < $loan->term_years; $i++)
                                <th style="text-align: center;">Principal</th>
                                <th style="text-align: center;">Interest</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @for ($x = 0; $x < count($months); $x++)
                            <tr>
                                <td>{{$months[$x]}}</td>
                                @for ($i = $recordEnd; $i >= $recordStart; $i--)
                                    @php
                                        $targetMonth = $months[$x];
                                        $targetYear = $i;
                                        $amortStartYear = $amort_start->copy()->addMonths($i * 12)->format('Y');
                                        $paymentCount = isset($filteredPayments[$targetYear][$targetMonth]) ? count($filteredPayments[$targetYear][$targetMonth]) : 0;
                                        $principal = 0;
                                        $interest = 0;

                                        if(isset($filteredPayments[$targetYear][$targetMonth])){
                                            foreach($filteredPayments[$targetYear][$targetMonth] as $payment){
                                                $principal += $payment->principal;
                                                $interest += $payment->interest;
                                            }
                                        }
                                    @endphp

                                    @if($paymentCount > 0)
                                        <td style="text-align: center;">{{ number_format($principal, 2, '.', ',') }}</td>
                                        <td style="text-align: center;">{{ number_format($interest, 2, '.', ',') }}</td>
                                    @elseif($amortStartSubMonth->format('F') === $targetMonth && $amortStartSubMonth->year == $targetYear)
                                        <td colspan="2" style="text-align: center; font-weight: bold;">Loan Granted</td>
                                    @else
                                        <td colspan="2"></td> {{-- Empty cell, No Payment--}}
                                    @endif
                                @endfor
                            </tr>
                        @endfor

                        <tr>
                            <td style="border-top: 2px solid black; font-weight: bold;">Total</td>
                            @for ($i = $recordEnd; $i >= $recordStart; $i--)
                                @php
                                    $targetYear = $i;
                                    $principalTotal = 0;
                                    $interestTotal = 0;
                                    //get the totals
                                    if(isset($filteredPayments[$targetYear])){
                                        foreach($filteredPayments[$targetYear] as $month){
                                            foreach($month as $payment){
                                                $principalTotal += $payment->principal;
                                                $interestTotal += $payment->interest;
                                            }
                                        }
                                    }
                                @endphp
                                <td style="border-top: 2px solid black; font-weight: bold; text-align: center;">
                                    @if ($principalTotal)
                                    {{ number_format($principalTotal, 2,'.' , ',') }}
                                    @endif
                                </td>
                                <td style="border-top: 2px solid black; font-weight: bold; text-align: center;">
                                    @if ($interestTotal)
                                    {{ number_format($interestTotal, 2, '.' , ',') }}
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    </tbody>
                </table>
</body>
</html>

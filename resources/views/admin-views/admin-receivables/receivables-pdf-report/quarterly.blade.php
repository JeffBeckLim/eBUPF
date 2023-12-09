<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            font-family: Verdana, sans-serif;
        }
        .header {
            width: 100%;
            margin-top: 10px;
            display: table;
        }

        .logo {
            display: table-cell;
            width: 30%;
        }

        .center-text {
            display: table-cell;
            font-weight: bold;
            text-align: center;
            width: 40%;
            font-size: 12px;
            line-height: 1.6;
        }

        .right-corner{
            display: table-cell;
            width: 30%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/BU-logo.png'))) }}" alt="logo" style="width:80px; height: 80px; display: block; margin-left: 110px;">
        </div>
        <div class="center-text">
            BICOL UNIVERSITY PROVIDENT FUND <br><span style="font-weight:normal;">Bicol University </span><br> <span style="font-weight:normal;">Legazpi City</span>
        </div>
        <div class="right-corner">

        </div>
    </div>
    <div class="header">
        <div>
        </div>
        <div class="center-text">
            <span style="font-size: 12px;">SCHEDULE OF RECEIVABLES </span> <br> <span style="font-size: 12px; font-weight: normal; text-transform:uppercase;">As of December {{$selectedYear}}</span>
        </div>
        <div class="right-corner">

        </div>
    </div>
    <div style="margin-top: 12px;">
        <span style="font-size: 12px; font-weight: bold;">UNIT: </span> <span style="font-size: 12px; font-weight: bold; text-transform: uppercase;">{{ $unitName }}</span>
    </div>
    <table style="margin-top: 8px; font-size: 12px;">

        <thead>
            <tr>
                <th width="3%" rowspan="3" style="text-align: center;">No.</th>
                <th width="10%" rowspan="3" style="text-align: center;">Name of Borrower</th>
                <th colspan="6" style="text-align: center; color: rgb(162, 0, 0);">LOANS RECEIVABLE</th>
                <th colspan="6" style="text-align: center; color: rgb(162, 0, 0);">INTEREST RECEIVABLE</th>
            </tr>
            <tr>
                <th rowspan="2" style="text-align: center;">Balances as of {{$lastDayPreviousYear}}</th>
                <th colspan="4" style="text-align: center;">Payments</th>
                <th rowspan="2" style="text-align: center;">Balances as of {{$lastDayThisYear}}</th>
                <th rowspan="2" style="text-align: center;">Balances as of {{$lastDayPreviousYear}}</th>
                <th colspan="4" style="text-align: center;">Payments</th>
                <th rowspan="2" style="text-align: center;">Balances as of {{$lastDayThisYear}}</th>
            </tr>
            <tr>

                <th style="text-align: center;">1st Quarter</th>
                <th style="text-align: center;">2nd Quarter</th>
                <th style="text-align: center;">3rd Quarter</th>
                <th style="text-align: center;">4th Quarter</th>
                <th style="text-align: center;">1st Quarter</th>
                <th style="text-align: center;">2nd Quarter</th>
                <th style="text-align: center;">3rd Quarter</th>
                <th style="text-align: center;">4th Quarter</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 1; @endphp
            @if($loans->count() > 0)
                @foreach($loans as $loan)
                    <tr>
                        <td style="text-align: center;">{{ $count++ }}</td>
                        <td>{{ $loan->member->firstname }} {{ $loan->member->lastname }}</td>
                        <td>{{ isset($yearBalance[$loan->id]['beginning_balance_principal']) ? number_format($yearBalance[$loan->id]['beginning_balance_principal'], 2) : '' }}</td>
                        <td>{{ isset($quarterlyPayments[$loan->id][$selectedYear][1]) ? number_format($quarterlyPayments[$loan->id][$selectedYear][1], 2) : '' }}</td>
                        <td>{{ isset($quarterlyPayments[$loan->id][$selectedYear][2]) ? number_format($quarterlyPayments[$loan->id][$selectedYear][2], 2) : '' }}</td>
                        <td>{{ isset($quarterlyPayments[$loan->id][$selectedYear][3]) ? number_format($quarterlyPayments[$loan->id][$selectedYear][3], 2) : '' }}</td>
                        <td>{{ isset($quarterlyPayments[$loan->id][$selectedYear][4]) ? number_format($quarterlyPayments[$loan->id][$selectedYear][4], 2) : '' }}</td>
                        <td>{{ isset($yearBalance[$loan->id]['ending_balance_principal']) ? number_format($yearBalance[$loan->id]['ending_balance_principal'], 2) : '' }}</td>
                        <td>{{ isset($yearBalance[$loan->id]['beginning_balance_interest']) ? number_format($yearBalance[$loan->id]['beginning_balance_interest'], 2) : '' }}</td>
                        <td>{{ isset($quarterlyPaymentsForInterest[$loan->id][$selectedYear][1]) ? number_format($quarterlyPaymentsForInterest[$loan->id][$selectedYear][1], 2) : '' }}</td>
                        <td>{{ isset($quarterlyPaymentsForInterest[$loan->id][$selectedYear][2]) ? number_format($quarterlyPaymentsForInterest[$loan->id][$selectedYear][2], 2) : '' }}</td>
                        <td>{{ isset($quarterlyPaymentsForInterest[$loan->id][$selectedYear][3]) ? number_format($quarterlyPaymentsForInterest[$loan->id][$selectedYear][3], 2) : '' }}</td>
                        <td>{{ isset($quarterlyPaymentsForInterest[$loan->id][$selectedYear][4]) ? number_format($quarterlyPaymentsForInterest[$loan->id][$selectedYear][4], 2) : '' }}</td>
                        <td>{{ isset($yearBalance[$loan->id]['ending_balance_interest']) ? number_format($yearBalance[$loan->id]['ending_balance_interest'], 2) : '' }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" style="text-align: center; font-weight: bold;">TOTAL</td>
                    <td style="font-weight: bold;">{{ number_format($totalBeginningBalancePrincipal, 2) }}</td>
                    <td style="font-weight: bold;">{{ number_format($totalPrincipalPayments[$selectedYear][1], 2) }}</td>
                    <td style="font-weight: bold;">{{ number_format($totalPrincipalPayments[$selectedYear][2], 2) }}</td>
                    <td style="font-weight: bold;">{{ number_format($totalPrincipalPayments[$selectedYear][3], 2) }}</td>
                    <td style="font-weight: bold;">{{ number_format($totalPrincipalPayments[$selectedYear][4], 2) }}</td>
                    <td style="font-weight: bold;">{{ number_format($totalEndingBalancePrincipal, 2) }}</td>
                    <td style="font-weight: bold;">{{ number_format($totalBeginningBalanceInterest, 2) }}</td>
                    <td style="font-weight: bold;">{{ number_format($totalInterestPayments[$selectedYear][1], 2) }}</td>
                    <td style="font-weight: bold;">{{ number_format($totalInterestPayments[$selectedYear][2], 2) }}</td>
                    <td style="font-weight: bold;">{{ number_format($totalInterestPayments[$selectedYear][3], 2) }}</td>
                    <td style="font-weight: bold;">{{ number_format($totalInterestPayments[$selectedYear][4], 2) }}</td>
                    <td style="font-weight: bold;">{{ number_format($totalEndingBalanceInterest, 2) }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="14" style="text-align: center;">No Data</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>

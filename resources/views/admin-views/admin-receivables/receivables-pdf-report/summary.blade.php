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
            font-size: 14px;
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
    <div class="header" style="margin-top: 20px;">
        <div class="logo">
        </div>
        <div class="center-text">
            <span style="font-size: 18px;">SUMMARY LOANS RECEIVABLE <br> {{$type}}</span> <br> <span style="font-size: 12px;">As of {{$lastMonth}} {{$lastDay}}, {{$year}}</span>
        </div>
        <div class="right-corner">

        </div>
    </div>

    <table style="margin-top: 30px; font-size: 13px;">
        <thead>
            <tr>
                <th width="15%" rowspan="2" style="text-align: center;">Unit</th>
                <th width="10%" rowspan="2" style="text-align: center;">No. of Members</th>
                <th colspan="2" style="text-align: center;">Loan Payments</th>
                <th rowspan="2" style="text-align: center;">Total</th>
            </tr>
            <tr>
                <th style="text-align: center;">Principal</th>
                <th style="text-align: center;">Interest</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalMembers = 0;
                $totalPrincipal = 0;
                $totalInterest = 0;
            @endphp
            @foreach($combinedYearlyBalances as $unitCode => $yearlyBalance)
                @if(isset($yearlyBalance[$year]))
                    @php
                        $unit = App\Models\Unit::where('unit_code', $unitCode)->first();
                        $unitMembersCount = $unit->members->count();
                        $totalMembers += $unitMembersCount;
                        $totalPrincipal += $yearlyBalance[$year]['ending_balance_principal'];
                        $totalInterest += $yearlyBalance[$year]['ending_balance_interest'];
                    @endphp
                    <tr>
                        <td style="text-align: center;">{{ $unitCode }}</td>
                        <td style="text-align: center;">{{ $unitMembersCount }}</td>
                        <td>{{ number_format($yearlyBalance[$year]['ending_balance_principal'], 2) }}</td>
                        <td>{{ number_format($yearlyBalance[$year]['ending_balance_interest'], 2) }}</td>
                        <td style="font-weight: bold;">{{ number_format($yearlyBalance[$year]['ending_balance_principal'] + $yearlyBalance[$year]['ending_balance_interest'], 2) }}</td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td style="text-align: center; font-weight: bold;">Totals</td>
                <td style="text-align: center;">{{ $totalMembers }}</td>
                <td>{{ number_format($totalPrincipal, 2) }}</td>
                <td>{{ number_format($totalInterest, 2) }}</td>
                <td style="font-weight: bold;">{{ number_format($totalPrincipal + $totalInterest, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="header" style="margin-top: 30px;">
        <div class="logo">
        </div>
        <div class="center-text">
        </div>
        <div class="right-corner">
            <span style="font-size: 12px;">Certified True and Correct:</span> <br><br><br>
            <span style="font-weight: bold; font-size: 13px;">ATTY. LOYD P. CASASIS</span> <br>
            <div  style="margin-left: 30px;">
                <span style="font-size: 12px;">Executive Director</span>
            </div>
        </div>
    </div>

</body>
</html>

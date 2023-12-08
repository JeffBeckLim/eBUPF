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
            <span style="font-size: 12px;">SCHEDULE OF RECEIVABLES </span> <br> <span style="font-size: 12px; font-weight: normal;">As of Month Day, Year</span>
        </div>
        <div class="right-corner">

        </div>
    </div>
    <table style="margin-top: 20px; font-size: 12px;">
        <thead>
            <tr>
                <th width="3%" rowspan="3" style="text-align: center;">No.</th>
                <th width="10%" rowspan="3" style="text-align: center;">Name of Borrower</th>
                <th colspan="6" style="text-align: center; color: rgb(162, 0, 0);">LOANS RECEIVABLE</th>
                <th colspan="6" style="text-align: center; color: rgb(162, 0, 0);">INTEREST RECEIVABLE</th>
            </tr>
            <tr>
                <th rowspan="2" style="text-align: center;">Balances as of 12/31/2022</th>
                <th colspan="4" style="text-align: center;">Payments</th>
                <th rowspan="2" style="text-align: center;">Balances as of 12/31/2023</th>
                <th rowspan="2" style="text-align: center;">Balances as of 12/31/2022</th>
                <th colspan="4" style="text-align: center;">Payments</th>
                <th rowspan="2" style="text-align: center;">Balances as of 12/31/2023</th>
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
            <tr>
                <td>1</td>
                <td>Aaron Labini</td>
                <td>200,000.00</td>
                <td>20,000.00</td>
                <td>20,000.00</td>
                <td>20,000.00</td>
                <td>20,000.00</td>
                <td>120,000.00</td>
                <td>36,0000.00</td>
                <td>3,000.00</td>
                <td>3,000.00</td>
                <td>3,000.00</td>
                <td>3,000.00</td>
                <td>24,000.00</td>
            </tr>
        </tbody>
    </table>
</body>
</html>

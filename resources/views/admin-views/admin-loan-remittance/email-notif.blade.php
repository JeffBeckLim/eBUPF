<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: rgb(239, 239, 239);
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        p {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Hello {{ $member->firstname }},</h3>

        <p>This is to inform you that your
            @if($loan->loanType->loan_type_name == 'MPL')
                Multi-Purpose Loan
            @elseif($loan->loanType->loan_type_name == 'HSL')
                Housing Loan
            @endif
            , bearing code <span style="color: green;">{{$loan->loan_code}}</span> has received a payment on {{$date}}.
        </p>

        <p>
            Payment Details: <br>
            <strong>OR Number:</strong> {{ $OR_number }} <br>
            <strong>Principal:</strong> {{ $principal_amount }} <br>
            <strong>Interest:</strong> {{ $interest }} <br>
        </p>

        <p>
            You may now view your updated loan balance or download your personal ledger on the <a href="{{ url('/login') }}"><u>eBUPF</u></a> website.
        </p>

       <p style="color: grey;">
        Note: If you have any questions, please contact us at (+63) 927-0256-413 or email us at ebupf.lms@gmail.com
       </p>
    </div>
</body>

</html>

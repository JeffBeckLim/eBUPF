<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Accepted</title>
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

        <p>
            We're delighted to inform you that your
            @if($loan_type == 'MPL')
                Multi-Purpose Loan
            @elseif($loan_type == 'HSL')
                Housing Loan
            @endif
            , bearing code <span style="color: green;">{{$loan_code}}</span>, has been approved.
        </p>
        <p>
            You're now eligible to collect your check from the BUPF Office. Prior to claiming your check, we kindly request you to access and print your insurance form available on the <a href="{{ url('/login') }}"><u>eBUPF</u></a> website. Simply log in to your account on the website and select 'Your Applications' from the sidebar menu.
        </p>

       <p style="color: grey;">
        Note: You will be required to present your insurance form and valid IDs upon claiming your check.
       </p>
    </div>
</body>

</html>

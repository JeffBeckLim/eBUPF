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
        <h3>Membership Application <span style="color: red;">Rejected</span></h3>

        <p>Hi, {{ $member->firstname }}!</p>

        <p>
            We regret to inform you that your membership application for the Bicol Univesity Provident fund has been rejected. <br> <br>
            You did not meet the requirements for the membership application. Please try again next time.
        </p>

        <p>
            Thank you for your interest in joining the Bicol University Provident Fund.
        </p>

        <p style="color: grey;">
            Note: If you have any questions, please contact us at (+63) 927-0256-413 or email us at ebupf.lms@gmail.com
        </p>
    </div>
</body>

</html>

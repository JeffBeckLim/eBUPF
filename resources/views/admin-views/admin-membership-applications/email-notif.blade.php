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

        h1 {
            color: #0082BA;
        }

        p {
            margin-bottom: 15px;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 15px;
            background-color: #0082BA;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 3px;
        }

        a:hover {
            background-color: #005796;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Membership Accepted</h1>

        <p>Congratulations, {{ $member->firstname }}! Your membership has been accepted.</p>

        <p>Login now to access your member dashboard and start your journey with us!</p>

        <a href="{{ url('/') }}">Login Now!</a>

        <p>If you have any questions, feel free to contact us.</p>

        <p>
            Best regards, <br> <span style="font-weight: bold;">eBUPF Team</span>
        </p>
    </div>
</body>

</html>

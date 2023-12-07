<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
        .login-button-container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-button {
            width: auto;
            padding: 15px;
            font-size: 0.9rem;
            background-color: #0082BA !important;
            border-radius: 10px;
            color: #fff !important;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease !important;
        }

        .login-button:hover {
            background-color: #005275 !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Hello {{ $member->firstname }},</h2>
        <p>
            Welcome to the new online home of the Bicol University Provident Fund! <br> <br>

            Here's what you can look forward to: <br> <br>
            - <span style="font-weight: bold; color: #FF6F19;">Fill out loan application forms</span> online. <br>
            - <span style="font-weight: bold; color: #FF6F19;">Track your loan application</span> in real-time, from submission to approval. <br>
            - <span style="font-weight: bold; color: #FF6F19;">Download your personal ledger</span> and stay updated on your transactions. <br>
            - Discover <span style="font-weight: bold; color: #FF6F19;">many more</span> convenient features designed to enhance your experience.
        </p>
        <p>
            Our digital platform is dedicated to providing you with a seamless and secure way to access your provident fund services anytime, anywhere.
        </p>
        <div>
            <p>
                Login using your <span style="font-weight: bold; color: #00638D;">BU email</span> and your temporary password is <span style="font-weight: bold; color: #00638D;">Ch@ngeMe123</span>. <br> <br>

                <span style="font-weight: bold; color: #FF6F19;">
                    We highly recommend that you change your password upon logging in.
                </span>
                <br> <br>
                <div class="login-button-container">
                    <a href="{{ url('/login') }}">
                        <button class="login-button">Login Now!</button>
                    </a>
                </div>

                </a>
            </p>
        </div>
        <p style="font-weight: bold;">
            Warm regards, <br>
            eBUPF Team
        </p>
    </div>
</body>

</html>

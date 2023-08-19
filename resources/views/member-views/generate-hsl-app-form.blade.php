<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<style>

    body, table, td {
        font-family: 'Montserrat', sans-serif;
    }

    .toBold {
        font-weight: bold;
    }

    .header {
        display: table;
        width: 100%;
        margin-top: 10px;
    }

    .logo {
        display: table-cell;
        vertical-align: middle;
        width: 15%;
    }

    .center-text {
        display: table-cell;
        font-weight: bold;
        font-size: 15px;
        width: 55%;
        line-height: 1.6;
    }

    .right-corner{
        display: table-cell;
        font-weight: bold;
        font-size: 15px;
        width: 25%;
        line-height: 1.6;
    }

    .new-roman{
        font-family: 'Times New Roman', Times, serif;
    }

    .rectangle{
        height: 18px;
        width: 45px;
        border: 1px solid black;
        background-color: #ffffff;
        margin: auto;
    }

</style>
<body>
    <div class="header">
        <div class="logo">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/BU-logo.png'))) }}" alt="logo" style="width:80px; height: 80px;">
        </div>
        <div class="center-text">
            BICOL UNIVERSITY PROVIDENT FUND <br>Bicol University <br> Legazpi City
        </div>
        <div class="right-corner">
            BU PFI Form No. 05 <br><span>February 2012</span>
        </div>
    </div>

    <div class="new-roman" style="width: 100%; font-size: 17px; text-align: center; margin-top: 12px; margin-bottom: 5px;">
        HOUSING/HOUSE IMPROVEMENT/LIVELIHOOD LOAN
    </div>
    <div style="font-size: 12px; padding-bottom: 1px; margin-top: 3px; font-weight: bold; border-bottom: 2px solid black;">
        Instruction: Please fill up all black spaces.
    </div>

    <div class="new-roman" style="font-size: 15px; font-weight: bold; margin-bottom: 18px;">PRINCIPAL BORROWER</div>

    <div style="width: 100%; font-size: 15px; line-height: ">
        <span class="toBold">Name: </span> {{$lastname}}, {{$firstname}} {{$middle_initial}}.
    </div>

    <div style="display: table; width: 100%; font-size: 15px;margin-bottom: 12px;margin-top: 8px;">
        <div style="display: table-cell; width: 40%;">
            <span class="toBold">Date of Birth: </span> {{ $date_of_birth }}
        </div>
        <div style="display: table-cell; width: 20%;">
            <span class="toBold">Age: </span> {{$age}}
        </div>
        <div style="display: table-cell; width: 40%;">
            <span class="toBold">TIN: </span> {{$tin}}
        </div>
    </div>

    <div style="width: 100%; font-size: 15px; margin-bottom: 12px;">
        <span class="toBold">Permanent Address: </span> {{$address}}
    </div>

    <div style="width: 100%; font-size: 15px; margin-bottom: 12px;">
        <span class="toBold">Paying Campus/Unit: </span> {{$unit}}
    </div>

    <div style="display: table; width: 100%; font-size: 15px; margin-bottom: 12px;">
        <div style="display: table-cell; width: 60%;">
            <span class="toBold">Telephone No./Cell phone No.: </span> {{ $contact_number }}
        </div>
        <div style="display: table-cell; width: 40%;">
            <span class="toBold">Office: </span> {{$office}}
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 15px; ">
        <div style="display: table-cell; width: 60%;">
            <span class="toBold">Net Take Home Pay: </span> {{ $monthly_net_pay }} <br>  <span style="font-size: 12px; font-weight: bold; padding-left: 12px;">(inclusive of PERA)</span>
        </div>
        <div style="display: table-cell; width: 40%; 8px;">
            <span class="toBold">Amount Requested: </span> {{$amount_requested}}
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 60%;">
            <span class="toBold" style="padding-left: 12px; font-size: 12px; "> </span>
        </div>
        <div style="display: table-cell; width: 40%;font-size: 15px;">
            <span class="toBold">Preferred payment period: </span> {{$payment_period}}
        </div>
    </div>

    <div style="margin-top: 45px; display: table; width: 100%; font-size: 15px; margin-bottom: 12px;">
        <div style="display: table-cell; width: 50%;">

        </div>
        <div style="border-top: 1px solid black; text-align: center; display: table-cell; width: 50%;">
            <span class="toBold">Signature over Printed Name</span>
        </div>
    </div>

    <div class="new-roman" style="font-size: 15px; font-weight: bold; margin-bottom: 18px; border-top: 2px solid black; margin-top: 12px;">CO-BORROWER</div>

    <div style="width: 100%; font-size: 15px; line-height: ">
        <span class="toBold">Name: </span> {{$lastname}}, {{$firstname}} {{$middle_initial}}.
    </div>

    <div style="display: table; width: 100%; font-size: 15px;margin-bottom: 12px;margin-top: 8px;">
        <div style="display: table-cell; width: 40%;">
            <span class="toBold">Date of Birth: </span> {{ $date_of_birth }}
        </div>
        <div style="display: table-cell; width: 20%;">
            <span class="toBold">Age: </span> {{$age}}
        </div>
        <div style="display: table-cell; width: 40%;">
            <span class="toBold">TIN: </span> {{$tin}}
        </div>
    </div>

    <div style="width: 100%; font-size: 15px; margin-bottom: 12px;">
        <span class="toBold">Permanent Address: </span> {{$address}}
    </div>

    <div style="width: 100%; font-size: 15px; margin-bottom: 12px;">
        <span class="toBold">Paying Campus/Unit: </span> {{$unit}}
    </div>

    <div style="display: table; width: 100%; font-size: 15px; margin-bottom: 12px;">
        <div style="display: table-cell; width: 60%;">
            <span class="toBold">Telephone No./Cell phone No.: </span> {{ $contact_number }}
        </div>
        <div style="display: table-cell; width: 40%;">
            <span class="toBold">Office: </span> {{$office}}
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 15px; ">
        <div style="display: table-cell; width: 60%;">
            <span class="toBold">Net Take Home Pay: </span> {{ $monthly_net_pay }} <br>  <span style="font-size: 12px; font-weight: bold; padding-left: 12px;">(inclusive of PERA)</span>
        </div>
        <div style="display: table-cell; width: 40%; 8px;">
            <span class="toBold">Amount Requested: </span> {{$amount_requested}}
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 60%;">
            <span class="toBold" style="padding-left: 12px; font-size: 12px; "> </span>
        </div>
        <div style="display: table-cell; width: 40%;font-size: 15px;">
            <span class="toBold">Preferred payment period: </span> {{$payment_period}}
        </div>
    </div>

    <div style="margin-top: 45px; display: table; width: 100%; font-size: 15px; margin-bottom: 12px;">
        <div style="display: table-cell; width: 50%;">

        </div>
        <div style="border-top: 1px solid black; text-align: center; display: table-cell; width: 50%;">
            <span class="toBold">Signature over Printed Name</span>
        </div>
    </div>

    <div style="border-top: 2px solid black; margin-top: 15px;"></div>

    <div style="display: table; width: 100%; margin-bottom: 10px;">
        <div style="display: table-cell; width: 40%;">
            <span class="toBold" style="font-size: 15px; ">ATTACHMENTS (Please check):</span>
        </div>
        <div style="display: table-cell; width: 30%;font-size: 15px; text-align: center;">
            <span class="toBold">Borrower </span>
        </div>
        <div style="display: table-cell; width: 30%;font-size: 15px; text-align: center;">
            <span class="toBold">Co-Borrower </span>
        </div>
    </div>

    <div style="display: table; width: 100%;  margin-bottom: 10px;">
        <div style="display: table-cell; width: 40%;">
            <span class="toBold" style="font-size: 15px; ">1. Latest pay slips</span>
        </div>
        <div style="display: table-cell; width: 30%;font-size: 15px;">
            <div class="rectangle" >

            </div>
        </div>
        <div style="display: table-cell; width: 30%;font-size: 15px;">
            <div class="rectangle">

            </div>
        </div>
    </div>

    <div style="display: table; width: 100%; margin-bottom: 10px;">
        <div style="display: table-cell; width: 40%;">
            <span class="toBold" style="font-size: 15px; ">2. Duly Notarize Non-Negotiable Promissory Note with Deed of Assignment</span>
        </div>
        <div style="display: table-cell; width: 30%;font-size: 15px;">
            <div class="rectangle" >

            </div>
        </div>
        <div style="display: table-cell; width: 30%;font-size: 15px;">
            <div class="rectangle">

            </div>
        </div>
    </div>

    <div style="display: table; width: 100%; margin-bottom: 10px;">
        <div style="display: table-cell; width: 40%;">
            <span class="toBold" style="font-size: 15px; ">3. Properly-filled up application form</span>
        </div>
        <div style="display: table-cell; width: 30%;font-size: 15px;">
            <div class="rectangle" >

            </div>
        </div>
        <div style="display: table-cell; width: 30%;font-size: 15px;">
            <div class="rectangle">

            </div>
        </div>
    </div>

    <div style="border-top: 2px solid black; margin-top: 15px; font-size: 15px; font-weight: bold; margin-bottom: 20px;">ACTION OF THE LOANS & CREDIT COMMITEE:</div>

    <div style="display: table; width: 100%; margin-bottom: 10px;">
        <div style="display: table-cell; width: 15%;font-size: 15px;">
            <div class="rectangle" >

            </div>
        </div>
        <div style="display: table-cell; width: 85%;font-size: 15px;">
            <span class="toBold" style="font-size: 15px; ">RECOMMENDED</span>
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 15%;font-size: 15px;">
            <div class="rectangle" >

            </div>
        </div>
        <div style="display: table-cell; width: 85%;font-size: 15px;">
            <span class="toBold" style="font-size: 15px; ">NOT RECOMMENDED</span>
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 15%;font-size: 15px;">
        </div>
        <div style="display: table-cell; width: 85%;font-size: 15px; position:relative;">
            <span class="toBold" style="font-size: 12px;">Reason:</span> <div style="position: fixed; right: 0;border-bottom: 1px solid black; width: 77%; float: right; height: 20px;"></div>
        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 60px;">
        <div style="display: table-cell; width: 50%; text-align: font-weight: bold; text-align: center; font-size: 15px; " class="toBold">
            <div><u>MARY JANE A. VICUÑA</u></div>
        </div>
        <div style="display: table-cell; width: 85%;font-size: 15px;">

        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 50%; text-align: center; font-size: 15px;" class="toBold">
            Chair, Loans & Credit Committee
        </div>
        <div style="display: table-cell; width: 85%;font-size: 15px;">

        </div>
    </div>

    <div style="font-size: 12px;font-weight: bold; text-align: center; width: 100%; margin-top: 30px;position: absolute;
    bottom: 0;">
        Page 1 of 3
    </div>
</body>
</html>

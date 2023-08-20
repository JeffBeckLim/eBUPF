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

    .page_break {
        page-break-before: always;
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

    <div class="page_break"></div>

    <div class="toBold new-roman" style="font-size: 16px; margin-top: 15px; margin-bottom: 18px;">
        COMPUTATION
    </div>

    <div style="font-size: 14px;" class="toBold">
        LOANABLE AMOUNT:
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 40%; font-size: 14px; font-weight: bold;">
            Monthly Basic Pay (Inclusive of PERA)
        </div>
        <div style="display: table-cell; width: 15%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 35%; font-weight: bold;">
            Php <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;"></div>
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell;text-align: center; width: 40%; font-size: 14px; font-weight: bold;">
        X3
        </div>
        <div style="display: table-cell; width: 20%; font-weight: bold;">
        </div>
        <div style="display: table-cell; width: 30%; font-weight: bold;">
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 40%; font-size: 14px; font-weight: bold;">
            Total Loanable Amount
        </div>
        <div style="display: table-cell; width: 15%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 35%; font-weight: bold;">
            Php <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;"></div>
        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 15px;">
        <div style="display: table-cell; width: 50%; font-size: 14px; font-weight: bold;">
            AMOUNT GRANTED
        </div>
        <div style="display: table-cell; width: 15%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 35%; font-weight: bold;">
            Php <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;"></div>
        </div>
    </div>

    <div style="font-size: 14px; margin-top: 15px;" class="toBold">
        LOAN PROCEEDS:
    </div>

    <div style="display: table; width: 100%; margin-top: 5px;">
        <div style="display: table-cell; width: 50%; font-size: 14px; font-weight: bold;">
            Principal Loan
        </div>
        <div style="display: table-cell; width: 15%; font-weight: bold;">
        </div>
        <div style="display: table-cell; width: 35%; font-weight: bold;">
            Php <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;"></div>
        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 5px;">

        <div style="display: table-cell; width: 7%; font-size: 14px; font-weight: bold;">
        Less:
        </div>
        <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
            Interest - 9%
        </div>

        <div style="display: table-cell; width: 30%; font-weight: bold; font-size: 14px;">

        </div>
        <div style="display: table-cell; width: 38%;">

        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 8px;">
        <div style="display: table-cell; width: 7%; font-size: 14px; font-weight: bold;">

            </div>
            <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
                (1st & 2nd yr)
            </div>

            <div style="display: table-cell; width: 30%; font-weight: bold; font-size: 14px;">
                Php <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 18px;"></div>
            </div>
            <div style="display: table-cell; width: 38%;">

            </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 8px;">
        <div style="display: table-cell; width: 7%; font-size: 14px; font-weight: bold;">

            </div>
            <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
                Service Fee - 1%
            </div>

            <div style="display: table-cell; width: 30%; font-weight: bold; font-size: 14px;">
                 <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 18px;"></div>
            </div>
            <div style="display: table-cell; width: 38%;">

            </div>
    </div>
    <div style="display: table; width: 100%; margin-top: 8px;">
        <div style="display: table-cell; width: 7%; font-size: 14px; font-weight: bold;">

            </div>
            <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
                MRI (0.88/1000)
            </div>

            <div style="display: table-cell; width: 30%; font-weight: bold; font-size: 14px;">
                 <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 18px;"></div>
            </div>
            <div style="display: table-cell; width: 38%;">

            </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 8px;">
        <div style="display: table-cell; width: 7%; font-size: 14px; font-weight: bold;">

            </div>
            <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
                Bal. Prev. Loan (if any)
            </div>

            <div style="display: table-cell; width: 30%; font-weight: bold; font-size: 14px;">
                 <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 18px;"></div>
            </div>
            <div style="display: table-cell; width: 38%;">

            </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 8px;">
        <div style="display: table-cell; width: 7%; font-size: 14px; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
            others
        </div>

        <div style="display: table-cell; width: 30%; font-weight: bold; font-size: 14px;">
            <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 18px;"></div>
        </div>
        <div style="display: table-cell; width: 38%;">
        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 15px;">
        <div style="display: table-cell; width: 50%; font-size: 14px; font-weight: bold;">
            NET LOAN PROCEEDS
        </div>
        <div style="display: table-cell; width: 15%; font-weight: bold;">
        </div>
        <div style="display: table-cell; width: 35%; font-weight: bold;">
            Php =======================
        </div>
    </div>

    <div style="font-size: 14px; margin-top: 15px;" class="toBold">
        MONTHLY AMORTIZATION:
    </div>

    <div style="display: table; width: 100%; margin-top: 3px;">
        <div style="display: table-cell; width: 7%; font-size: 14px; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
            Principal
        </div>

        <div style="display: table-cell; width: 30%; font-weight: bold; font-size: 14px;">
            Php<div style="width: 80%; border-bottom: 1px solid black;float: right; height: 18px;"></div>
        </div>
        <div style="display: table-cell; width: 38%;">
        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 8px;">
        <div style="display: table-cell; width: 7%; font-size: 14px; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
            Interest
        </div>

        <div style="display: table-cell; width: 30%; font-weight: bold; font-size: 14px;">
            <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 18px;"></div>
        </div>
        <div style="display: table-cell; width: 38%;">
        </div>
    </div>
    <div style="display: table; width: 100%; margin-top: 23px;">
        <div style="display: table-cell; width: 7%; font-size: 14px; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
            Total
        </div>

        <div style="display: table-cell; width: 30%; font-weight: bold; font-size: 14px;">
            Php &nbsp;&nbsp;&nbsp;&nbsp; ====================
        </div>
        <div style="display: table-cell; width: 38%;">
        </div>
    </div>

    <div style="font-size: 14px; margin-top: 20px;" class="toBold">
        AMORTIZATION PERIOD: ______________________________________________________
    </div>

    <div style="border-bottom: 2px solid black; margin-top: 20px; margin-bottom: 20px;"></div>

    <div style="display: table; width: 100%; margin-top: 15px;">
        <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
            Processed by:
        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            <div style="border-bottom: 1px solid black;height: 18px;"></div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
             <div style="width: 100%; border-bottom: 1px solid black;float: right; height: 18px;"></div>
        </div>
        <div style="display: table-cell; width: 10%; font-size: 14px; font-weight: bold;">
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
        </div>
        <div style="display: table-cell; width: 30%; text-align: center; font-size: 14px; font-weight: bold;">
            Account Analyst
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold; text-align: center">
            Date
        </div>
        <div style="display: table-cell; width: 10%; font-size: 14px; font-weight: bold;">
        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 25px;">
        <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
            Approved by:
        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            <div style="border-bottom: 1px solid black;height: 18px;"></div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            <div style="width: 100%; border-bottom: 1px solid black;float: right; height: 18px;"></div>
        </div>
        <div style="display: table-cell; width: 10%; font-size: 14px; font-weight: bold;">
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
        </div>
        <div style="display: table-cell; width: 30%; text-align: center; font-size: 14px; font-weight: bold;">
            Executive Director
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold; text-align: center;">
            Date
        </div>
        <div style="display: table-cell; width: 10%; font-size: 14px; font-weight: bold;">
        </div>
    </div>

    <div style="margin-top: 20px; width: 100%; font-size: 14px; text-align: justify;">
        I acknowledge receipt of a copy of this HOUSING/HOUSE IMPROVEMENT/LIVELIHOOD LOAN computation prior to the consummation of the loan/credit transaction and that I fully understand and agree to the terms and conditions thereof.
        <br><br>
        Further, I authorize the BU Provident Fund to obtain access of my payroll information from the BU Accounting/Cashier's Office to verify my credit worthiness upon application and to review my paying capacity in case of default or failure to pay the monthly amortization of this loan.
    </div>


    <div style="display: table; width: 100%; margin-top: 35px;">
        <div style="display: table-cell; width: 5%; font-weight: bold; font-size: 14px;">
        </div>
        <div style="display: table-cell; width: 45%; font-weight: bold; border-bottom: 1px solid black; height: 20px;">

        </div>
        <div style="display: table-cell; width: 5%; font-size: 14px; font-weight: bold;">
        </div>
        <div style="display: table-cell; width: 40%; font-weight: bold; border-bottom: 1px solid black; height: 20px;">

        </div>
        <div style="display: table-cell; width: 5%; font-size: 14px; font-weight: bold;">
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 5%; font-weight: bold; font-size: 14px;">
        </div>
        <div style="display: table-cell; width: 45%; font-weight: bold; text-align: center; font-size: 14px;">
            Signature over printed name of <br> PRINCIPAL BORROWER
        </div>
        <div style="display: table-cell; width: 5%; font-size: 14px; font-weight: bold;">
        </div>
        <div style="display: table-cell; width: 40%; font-weight: bold;text-align: center;  font-size: 14px;">
            Signature over printed name of <br> CO-BORROWER
        </div>
        <div style="display: table-cell; width: 5%; font-size: 14px; font-weight: bold;">
        </div>
    </div>

    <div style="font-size: 12px;font-weight: bold; text-align: center; width: 100%; margin-top: 30px;position: absolute;
bottom: 0;">
    Page 2 of 3
</div>

    <div class="page_break"></div>

    <div style="width: 100%; position:">
        <div class="new-roman" style="width: 75%; font-weight: bold; font-size: 17px; text-align: center; margin: auto;">
            NON-NEGOTIABLE PROMISSORY NOTE <br> WITH DEED OF ASSIGNMENT
        </div>
    </div>

    <div class="new-roman" style="width: 100%; font-size: 14px; font-weight: bold; margin-top: 10px;">
        PRINCIPAL BORROWER
    </div>

    <div style="display: table; width: 100%; margin-top: 5px; font-size: 15px">
        <div style="display: table-cell; width: 35%;">
            Php: {{$amount_requested}}
        </div>
        <div style="display: table-cell; width: 35%;">

        </div>
        <div style="display: table-cell; width: 30%;">
            Date: {{$currentdate}}
        </div>
    </div>

    <div style="margin-top: 15px; font-size: 14px;text-align: justify;">
        For value received, I <u>{{$firstname}} {{$middle_initial}}. {{$lastname}}</u>, an employee of Bicol University and a member of the BU Provident Fund, promise to pay to the BUPF the sum of _____________________________________________________ (Php ______________________) in monthly installments of Php ________________ each starting on ____________________ and thereafter on every corresponding date of the succeeding agreed installment period with interest thereon of _______% per annum until fully paid, subject to the terms and conditions prescribed by the BUPF.
    </div>

    <div style="margin-top: 10px; font-size: 14px;text-align: justify;">
        For the payment of all installments and amounts due and demandable under the Promissory Note, I hereby assign and transfer an amount equivalent to the monthly installment the salaries, wages, allowances and other benefits payable to me by the University.
    </div>

    <div style="margin-top: 10px; font-size: 14pxtext-align: justify;">
        I do hereby grant the BUPF, its management assign the full power and authority to deduct, withhold, collect and receive and give acquintance for the same or any part thereof, in may name of otherwise.
    </div>

    <div style="display: table; width: 100%; margin-top: 5px; font-size: 14px; margin-top: 25px;">
        <div style="display: table-cell; width: 40%; border-bottom: 1px solid black; height: 18px;">

        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-weight: bold; font-size: 14px;">
            CONFORME:
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 14px;">
        <div style="display: table-cell; width: 40%; font-size: 14px; text-align: center; font-weight: bold;">
            Principal Borrower
        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-weight: bold; font-size: 14px; padding-left: 50px;">
            BU PROVIDENT FUND
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 14px; ">
        <div style="display: table-cell; width: 40%; font-size: 14px; text-align: center;font-weight: bold;">
            Signature over Printed Name
        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-weight: bold; font-size: 14px; ">
            By:
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 14px; margin-top: 20px;">
        <div style="display: table-cell; width: 40%; font-size: 14px; text-align: center;">

        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-size: 14px; padding-left: 50px;">
            _______________________________
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 14px;">
        <div style="display: table-cell; width: 40%; font-size: 14px; text-align: center;">

        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-size: 14px;text-align: center; padding-left: 50px;font-weight: bold;">
            Executive Director
        </div>
    </div>

    <div style="margin-top: 15px; font-size: 14px; font-weight: bold;" class="new-roman">
        CO-BORROWER
    </div>

    <div style="margin-top: 15px; font-size: 14px;">
        I, <u>{{$co_firstname}} {{$co_middle_initial}}. {{$co_lastname}}</u>, an employee of Bicol University, and a member of the BU provident Fund, do hereby promise, in the event of default or non-payment by the Principal Borrower abovementioned, to pay the BUPF, the whole sum remaining unpaid under this Promissory Note, inclusive of interests, penalties or surcharges, in accordance with the terms and conditions hereof and of the Implementing Guidelines/Rules and Regulations for the Loan.
    </div>

    <div style="margin-top: 15px; font-size: 14px;">
        For purposes of payment, I hereby authorize the BUPF, upon Notice to set off, apply to the payment of, or otherwise give acquaintance for, the remaining unpaid balance of this Promissory Note, the equivalent amount from any and all salaries, wages, allowances and benefits payable to me.
    </div>

    <div style="display: table; width: 100%; margin-top: 5px; font-size: 14px; margin-top: 25px;">
        <div style="display: table-cell; width: 40%; border-bottom: 1px solid black; height: 18px;">

        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-weight: bold; font-size: 14px;">
            CONFORME:
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 14px;">
        <div style="display: table-cell; width: 40%; font-size: 14px; text-align: center; font-weight: bold;">
            Co-Borrower
        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-weight: bold; font-size: 14px; padding-left: 50px;">
            BU PROVIDENT FUND
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 14px; ">
        <div style="display: table-cell; width: 40%; font-size: 14px; text-align: center;font-weight: bold;">
            Signature over Printed Name
        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-weight: bold; font-size: 14px; ">
            By:
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 14px; margin-top: 20px;">
        <div style="display: table-cell; width: 40%; font-size: 14px; text-align: center;">

        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-size: 14px; padding-left: 50px;">
            _______________________________
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 14px;">
        <div style="display: table-cell; width: 40%; font-size: 14px; text-align: center;">

        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-size: 14px;text-align: center; padding-left: 50px; font-weight: bold;">
            Executive Director
        </div>
    </div>

    <div style="width: 100%;font-weight: bold; text-align: center; font-size: 14px; margin-top: 5px;">
        Signed in the Presence of
    </div>

    <div style="display: table; width: 100%; font-size: 14px; margin-top: 15px;">
        <div style="display: table-cell; width: 40%; border-bottom: 1px solid black; height: 18px;">

        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-size: 14px; padding-left: 50px;">
            _______________________________
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 14px;">
        <div style="display: table-cell; width: 40%; font-size: 14px; font-weight: bold; text-align: center;">
            Witness
        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; font-weight: bold; text-align: center;width: 45%; font-size: 14px; padding-left: 50px;">
            Witness
        </div>
    </div>
    <div style="display: table; width: 100%; font-size: 14px;">
        <div style="display: table-cell; width: 40%; font-size: 14px; font-weight: bold; text-align: center;">
            Signature over Printed Name
        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; font-weight: bold; text-align: center;width: 45%; font-size: 14px; padding-left: 50px;">
            Signature over Printed Name
        </div>
    </div>

    <div class="new-roman" style="width: 100%;font-weight: bold; text-align: center; font-size: 16px; margin-top: 5px;">
        ACKNOWELEDGEMENT
    </div>

    <div style="font-weight: bold; font-size: 14px; margin-top: 5px; line-height: 1.1;">
        Republic of the Philippines<br>_______________________s.s <br>X_______________________X
    </div>

    <div style="font-size: 14px; margin-top: 10px;">
        BEFORE ME, a Notary Public, for the city/province of ___________________, Philippines, on this day __________, 20_____, personally appeared the following persons with their Community Tax Certificates as hereunder indicated.
    </div>

    <div style="display: table; width: 100%; font-size: 14px; margin-top: 10px;">
        <div style="display: table-cell; width: 40%; font-size: 14px; font-weight: bold; text-align: center;">
            Name
        </div>
        <div style="display: table-cell; width: 25%; font-size: 14px; font-weight: bold;text-align: center">
            CTC No.
        </div>
        <div style="display: table-cell; font-weight: bold; text-align: center;width: 45%; font-size: 14px;">
            Date/Place Issued
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 14px; margin-top: 5px;">
        <div style="display: table-cell; width: 40%; font-size: 14px; font-weight: bold; text-align: center;">
            1. _______________________________
        </div>
        <div style="display: table-cell; width: 25%; font-size: 14px; font-weight: bold;text-align: center">
            __________________
        </div>
        <div style="display: table-cell; font-weight: bold; text-align: center;width: 45%; font-size: 14px;">
            ___________________________
        </div>
    </div>
    <div style="display: table; width: 100%; font-size: 14px; margin-top: 5px;">
        <div style="display: table-cell; width: 40%; font-size: 14px; font-weight: bold; text-align: center;">
            2. _______________________________
        </div>
        <div style="display: table-cell; width: 25%; font-size: 14px; font-weight: bold;text-align: center">
            __________________
        </div>
        <div style="display: table-cell; font-weight: bold; text-align: center;width: 45%; font-size: 14px;">
            ___________________________
        </div>
    </div>
    <div style="display: table; width: 100%; font-size: 14px; margin-top: 5px;">
        <div style="display: table-cell; width: 40%; font-size: 14px; font-weight: bold; text-align: center;">
            3. _______________________________
        </div>
        <div style="display: table-cell; width: 25%; font-size: 14px; font-weight: bold;text-align: center">
            __________________
        </div>
        <div style="display: table-cell; font-weight: bold; text-align: center;width: 45%; font-size: 14px;">
            ___________________________
        </div>
    </div>

    <div style="margin-top: 8px; font-size: 14px;text-align: justify;">
        Known to me and to me known to be the same persons who executed the foregoing instrument and they acknowledged to me the same in their free and voluntary act and deed and that of the entity represented.
    </div>

    <div style="margin-top: 12px; font-size: 14px; font-weight: bold;">
        WITNESS MY HAND AND SEAL on this day ______ day of _______, 20_____ at _________________.
    </div>

    <div style="display: table; width: 100%; font-size: 14px; margin-top: 10px;">
        <div style="display: table-cell; width: 40%; font-size: 14px; font-weight: bold;">
            Doc. No. ___________________
        </div>
        <div style="display: table-cell; width: 25%; font-size: 14px; font-weight: bold;text-align: center">
            NOTARY PUBLIC
        </div>
        <div style="display: table-cell; font-weight: bold; text-align: center;width: 45%; font-size: 14px;">

        </div>
    </div>
    <div style="font-weight: bold; font-size: 14px;">
        Page No. ___________________ <br> Book No. ___________________ <br> Series of ___________________
    </div>

    <div style="font-size: 12px;font-weight: bold; text-align: center; width: 100%; margin-top: 30px;position: absolute;
    bottom: 0;">
        Page 3 of 3
    </div>

</body>
</html>

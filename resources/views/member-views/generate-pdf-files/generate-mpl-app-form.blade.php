<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
            text-align: center;
            font-weight: bold;
            vertical-align: middle;
            font-size: 15px;
            width: 55%;
        }

        .right-corner{
            display: table-cell;
            vertical-align: middle;
            font-weight: bold;
            text-align: center;
            font-size: 15px;
            width: 25%;
        }

        .prin-borrower{
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .solo{
            width: 100%;
            font-size: 14px;
            margin-bottom: 13px;
        }

        .trio{
            display: table;
            width: 100%;
            margin-bottom: 13px;
        }

        .trio-one{
            display: table-cell;
            width: 40%;
            font-size: 14px;
        }
        .trio-two{
            display: table-cell;
            width: 20%;
            font-size: 14px;
        }

        .trio-three{
            display: table-cell;
            width: 40%;
            font-size: 14px;
        }

        .duo{
            display: table;
            width: 100%;
            margin-bottom: 13px;
        }

        .duo-one{
            display: table-cell;
            width: 60%;
            font-size: 14px;
        }

        .duo-two{
            display: table-cell;
            width: 40%;
            font-size: 14px;
        }

        .co-borrower{
            width: 100%;
            border-top: 4px solid black;
            margin-top: 20px;
            padding-top: 8px;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .attachments{
            width: 100%;
            border-top: 4px solid black;
            font-size: 12px;
            margin-top: 10px;
            margin-bottom: 13px;
            font-weight: bold;
        }

        .attachment-trio{
            width: 100%;
            display: table;
            margin-top:2px;
        }

        .attachment-trio-one{
            display: table-cell;
            font-size: 14px;
            font-weight: bold;
            width: 50%;
        }
        .attachment-trio-two{
            display: table-cell;
            width: 25%;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
        }
        .attachment-trio-three{
            display: table-cell;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            width: 25%;
        }
        .myoval-one{
            display: table-cell;
            width: 25%;
        }
        .myoval-two{
            display: table-cell;
            width: 25%;
        }
        .oval-one{
            height: 18px;
            width: 35px;
            background-color: #fff;
            border: 1px solid black;
            border-radius: 65%;
            margin: auto;
        }
        .oval-two{
            height: 18px;
            width: 35px;
            background-color: #fff;
            border: 1px solid black;
            border-radius: 65%;
            margin: auto;
        }
        .line{
            width: 100%;
            margin-top: 20px;
            border-top: 4px solid black;
            margin-bottom: 13px;
        }
        .recommendation{
            display: table;
            width: 100%;
        }

        .myrectangle{
            width: 10%;
            display: table-cell;
        }
        .rectangle{
            height: 18px;
            width: 35px;
            border: 1px solid black;
            background-color: #ffffff;
            margin: auto;
        }
        .page_break {
            page-break-before: always;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/BU-logo.png'))) }}" alt="logo" style="width:80px; height: 80px;">
        </div>
        <div class="center-text">
            BICOL UNIVERSITY PROVIDENT FUND <br>MULTI - PURPOSE LOAN APPLICATION
        </div>
        <div class="right-corner">
            BU PFI Form No. 04 <br><span>February 2007</span>
        </div>
    </div>

    <div style="margin-top: 20px;">
        ===========================================================================
    </div>

    <div class="prin-borrower">
      PRINCIPAL BORROWER
    </div>

    <div class="solo">
        <span class="toBold">Name:</span> <span>{{$lastname}}, {{$firstname}}
            @if ($middle_initial != null)
                {{$middle_initial}}.
            @endif
        </span>
    </div>

    <div class="trio">
        <div class="trio-one">
            <span class="toBold">Date of Birth:</span> <span>{{$date_of_birth}}</span>
        </div>
        <div class="trio-two">
            <span class="toBold">Age:</span> <span>{{$age}}</span>
        </div>
        <div class="trio-three">
            <span class="toBold">Tin:</span> <span>{{$tin}}</span>
        </div>
    </div>

    <div class="solo">
        <span class="toBold">Permanent Address:</span> <span>{{$address}}</span>
    </div>

    <div class="solo">
        <span class="toBold">Unit:</span> <span>{{$unit}}</span>
    </div>

    <div class="duo">
        <div class="duo-one">
            <span class="toBold">Telephone/Cell phone No.:</span> <span>{{$contact_number}}</span>
        </div>
        <div class="duo-two">
            <span class="toBold">Office:</span> <span>{{$office}}</span>
        </div>
    </div>

    <div class="duo">
        <div class="duo-one">
            <span class="toBold">Monthly Net Pay (Including ACA & PERA):</span> <span>
                {{number_format($monthly_net_pay, 2, '.', ',')}}
            </span>
        </div>
        <div class="duo-two">
            <span class="toBold">Amount Requested:</span> <span>
                {{number_format($amount_requested, 2, '.', ',')}}
            </span>
        </div>
    </div>

    <div style="margin-top: 30px; display: table; width: 100%; font-size: 15px;">
        <div style="display: table-cell; width: 60%;">

        </div>
        <div style="text-align: center; display: table-cell; width: 40%; text-transform: uppercase;">
            {{$firstname}}
            @if($middle_initial != null)
                {{$middle_initial}}.
            @endif
            {{$lastname}}
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 15px; margin-bottom: 12px;">
        <div style="display: table-cell; width: 60%;">

        </div>
        <div style="border-top: 1px solid black; text-align: center; display: table-cell; width: 40%;">
            <span class="toBold">Signature over Printed Name</span>
        </div>
    </div>

    <div class="co-borrower">
        CO-BORROWER
    </div>
    <div class="solo">
        <span class="toBold">Name:</span> <span>{{$co_lastname}}, {{$co_firstname}}
            @if($co_middle_initial != null)
                {{$co_middle_initial}}.
            @endif
        </span>
    </div>

    <div class="trio">
        <div class="trio-one">
            <span class="toBold">Date of Birth:</span> <span>{{$co_date_of_birth}}</span>
        </div>
        <div class="trio-two">
            <span class="toBold">Age:</span> <span>{{$co_age}}</span>
        </div>
        <div class="trio-three">
            <span class="toBold">Tin:</span> <span>{{$co_tin}}</span>
        </div>
    </div>

    <div class="solo">
        <span class="toBold">Permanent Address:</span> <span>{{$co_address}}</span>
    </div>

    <div class="solo">
        <span class="toBold">Unit:</span> <span>{{$co_unit}}</span>
    </div>

    <div class="duo">
        <div class="duo-one">
            <span class="toBold">Telephone/Cell phone No.:</span> <span>{{$co_contact_number}}</span>
        </div>
        <div class="duo-two">
            <span class="toBold">Office:</span> <span>{{$co_office}}</span>
        </div>
    </div>

    <div class="duo">
        <div class="duo-one">
            <span class="toBold">Monthly Net Pay (Including ACA & PERA):</span> <span>
                {{number_format($co_monthly_net_pay, 2, '.', ',')}}
            </span>
        </div>
        <div class="duo-two">
            <span class="toBold">Amount Requested:</span> <span>
                {{number_format($co_amount_requested, 2, '.', ',')}}
            </span>
        </div>
    </div>

    <div style="margin-top: 30px; display: table; width: 100%; font-size: 15px;">
        <div style="display: table-cell; width: 60%;">

        </div>
        <div style="text-align: center; display: table-cell; width: 40%; text-transform: uppercase;">
           {{$co_firstname}}
           @if($co_middle_initial != null)
           {{$co_middle_initial}}.
           @endif
           {{$co_lastname}}
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 15px; margin-bottom: 12px;">
        <div style="display: table-cell; width: 60%;">

        </div>
        <div style="border-top: 1px solid black; text-align: center; display: table-cell; width: 40%;">
            <span class="toBold">Signature over Printed Name</span>
        </div>
    </div>

    <div class="attachments">
        Attachments (Please Shade)
    </div>

    <div class="attachment-trio">
        <div class="attachment-trio-one">

        </div>
        <div class="attachment-trio-two">
            Principal Borrower
        </div>
        <div class="attachment-trio-three">
            Co-Borrower
        </div>
    </div>

    <div class="attachment-trio" style="margin-top: 5px;">
        <div class="attachment-trio-one">
            1. HRD Certificate of permanent Employment
        </div>
        <div class="myoval-one">
            <div class="oval-one">

            </div>
        </div>
        <div class="myoval-two">
            <div class="oval-two">

            </div>
        </div>
    </div>
    <div class="attachment-trio" style="margin-top: 5px;">
        <div class="attachment-trio-one">
            2. Latest Pay slip
        </div>
        <div class="myoval-one">
            <div class="oval-one">

            </div>
        </div>
        <div class="myoval-two">
            <div class="oval-two">

            </div>
        </div>
    </div>

    <div class="line">
    </div>

    <div style="font-weight: bold; font-size: 14px; margin: 2px 0 15px 0;">
        ACTION OF THE LOANS & CREDIT COMMITEE:
    </div>

    <div class="recommendation">
        <div class="myrectangle">
            <div class="rectangle">

            </div>
        </div>
        <div style="font-size: 14px; font-weight: bold;">
            Recommended
        </div>
    </div>
    <div class="recommendation" style="margin: 10px 0;">
        <div class="myrectangle">
            <div class="rectangle">

            </div>
        </div>
        <div style="font-size: 14px; font-weight: bold;">
            Not Recommended
        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 40px;">
        <div style="display:table-cell; width: 30%; font-size: 14px; font-weight: bold;border-bottom: 1px solid black; text-align: center;">
            MARY JANE A. VICUÑA
        </div>
        <div>

        </div>
    </div>
    <div style="display: table; width: 100%;">
        <div style="display:table-cell; width: 30%; font-size: 12px; font-weight: bold; text-align: center;">
           Chair, Loans and Credit Commitee
        </div>
        <div>

        </div>
    </div>
    <div style="font-size: 12px;font-weight: bold; text-align: center; width: 100%; margin-top: 30px;position: absolute;
    bottom: 0;">
        Page 1
    </div>

    <div class="page_break"></div>

    <div class="toBold" style="text-align: center; font-size: 14px; margin-top: 15px; margin-bottom: 10px;">
        COMPUTATION
    </div>

    <div style="font-size: 14px;" class="toBold">
        LOANABLE AMOUNT
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 40%; font-size: 14px; font-weight: bold;">
            Monthly Pay (Inclusive of ACA/PERA)
        </div>
        <div style="display: table-cell; width: 20%; font-weight: bold;">
            ------------------------
        </div>
        <div style="display: table-cell; width: 30%; font-weight: bold;">
            Php <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;">{{ number_format($loan->basic_salary + 2000, 2, '.', ',') }}</div>
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
            Loanable Amount
        </div>
        <div style="display: table-cell; width: 20%; font-weight: bold;">
            ------------------------
        </div>
        <div style="display: table-cell; width: 30%; font-weight: bold;">
            Php <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;">{{ number_format(($loan->basic_salary + 2000) * 3, 2, '.', ',') }}</div>
        </div>
    </div>

    <div style="font-size: 14px; margin-top: 15px;" class="toBold">
        AMOUNT LOAN GRANTED
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 40%; font-size: 14px; font-weight: bold;">
        Amount of Loan Granted
        </div>
        <div style="display: table-cell; width: 20%; font-weight: bold;">
            ------------------------
        </div>
        <div style="display: table-cell; width: 30%; font-weight: bold;">
            Php <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;">{{number_format($loanAmountGranted, 2, '.', ',')}}</div>
        </div>
    </div>

    <div style="font-size: 14px;margin-top: 15px;" class="toBold">
        LOAN PROCEEDS
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 40%; font-size: 14px; font-weight: bold;">
        Principal Loan Granted
        </div>
        <div style="display: table-cell; width: 20%; font-weight: bold;">
            ------------------------
        </div>
        <div style="display: table-cell; width: 30%; font-weight: bold;">
            Php <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;">{{number_format($loanAmountGranted, 2, '.', ',')}}</div>
        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 15px;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 10%; font-size: 14px; font-weight: bold;">
        Less:
        </div>
        <div style="display: table-cell; width: 15%; font-weight: bold; font-size: 14px;">
            Interest
        </div>
        <div style="display: table-cell; width: 25%; font-weight: bold;font-size: 14px; ">
            <div style="width: 80%;  border-bottom: 1px solid black;height: 20px;"></div>
        </div>
        <div style="display: table-cell; width: 30%; font-weight: bold; font-size: 14px;">
            Php <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;"></div>
        </div>
        <div style="display: table-cell; width: 10%;">

        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 10%; font-size: 14px; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 15%; font-weight: bold; font-size: 14px;">
            MRI
        </div>
        <div style="display: table-cell; width: 25%; font-weight: bold;font-size: 14px; ">
            <div style="width: 80%;  border-bottom: 1px solid black;height: 20px;">{{number_format($mri, 2, '.', ',')}}</div>
        </div>
        <div style="display: table-cell; width: 30%; font-weight: bold; font-size: 14px;">
             <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;">{{number_format($loanAmountGranted - $mri, 2, '.', ',')}}</div>
        </div>
        <div style="display: table-cell; width: 10%;">

        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 10%; font-size: 14px; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 15%; font-weight: bold; font-size: 14px;">
            Loan Balance
        </div>
        <div style="display: table-cell; width: 25%; font-weight: bold;font-size: 14px; ">
            <div style="width: 80%;  border-bottom: 1px solid black;height: 20px;">{{number_format($prevLoanBalance, 2, '.', ',')}}</div>
        </div>
        <div style="display: table-cell; width: 30%; font-weight: bold; font-size: 14px;">
            <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;">
            @if($prevLoanBalance > 0)
                {{number_format($loanAmountGranted - $mri - $prevLoanBalance, 2, '.', ',')}}
            @endif
            </div>
        </div>
        <div style="display: table-cell; width: 10%;">

        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 10%; font-size: 14px; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 15%; font-weight: bold; font-size: 14px;">
            Service fee
        </div>
        <div style="display: table-cell; width: 25%; font-weight: bold;font-size: 14px; ">
            <div style="width: 80%;  border-bottom: 1px solid black;height: 20px;"></div>
        </div>
        <div style="display: table-cell; width: 30%; font-weight: bold; font-size: 14px;">
             <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;"></div>
        </div>
        <div style="display: table-cell; width: 10%;">

        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 10%; font-size: 14px; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 15%; font-weight: bold; font-size: 14px;">
            Others
        </div>
        <div style="display: table-cell; width: 25%; font-weight: bold;font-size: 14px; ">
            <div style="width: 80%;  border-bottom: 1px solid black;height: 20px;">
                @if ($loan->adjustment != null && $loan->adjustment->previous_penalty != null)
                    {{number_format($loan->adjustment->previous_penalty, 2, '.',',')}}
                @endif
            </div>
        </div>
        <div style="display: table-cell; width: 30%; font-weight: bold; font-size: 14px;">
             <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;">
                @if ($loan->adjustment != null && $loan->adjustment->previous_penalty != null && $loan->adjustment->previous_penalty > 0)
                    {{number_format($loanAmountGranted - $mri - $prevLoanBalance + $loan->adjustment->previous_penalty, 2, '.',',')}}
                @endif
            </div>
        </div>
        <div style="display: table-cell; width: 10%;">

        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 15px;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 20%; font-size: 14px; font-weight: bold;">
        NET PROCEEDS
        </div>
        <div style="display: table-cell; width: 40%; font-weight: bold;">
            ------------------------------------------------
        </div>
        <div style="display: table-cell; width: 30%; font-weight: bold;">
            Php <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;">{{number_format($netProceeds, 2, '.', ',')}}</div>
        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 20px;">
        <div style="display: table-cell; width: 50%; font-size: 14px; font-weight: bold;">
            MONTHLY AMORTIZATION:
        </div>
        <div style="display: table-cell; width: 50%; font-size: 14px; font-weight: bold;">
            AMORTIZATION/COLLECTION PERIOD:
        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 5px;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 35%; font-size: 14px; font-weight: bold;">
            Principal <div style="width: 70%; border-bottom: 1px solid black;float: right; height: 20px;">{{number_format($monthlyPrincipalAmort, 2, '.', ',')}}</div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 35%; font-weight: bold; font-size: 14px;">
            Start <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;">{{ $amortStart }}</div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 35%; font-size: 14px; font-weight: bold;">
            Interest <div style="width: 70%; border-bottom: 1px solid black;float: right; height: 20px;">{{number_format($monthlyInterestAmort, 2, '.', ',')}}</div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 35%; font-weight: bold; font-size: 14px;">
            End <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;">{{ $amortEnd }}</div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 35%; font-size: 14px; font-weight: bold;">
            Total <div style="width: 70%; border-bottom: 1px solid black;float: right; height: 20px;">{{number_format($monthlyAmort, 2, '.', ',')}}</div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 35%; font-weight: bold; font-size: 14px;">
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 20px;">
        <div style="display: table-cell; width: 50%; font-size: 14px; font-weight: bold;">
            COMPUTATION OF INTEREST PER ANNUM:
        </div>
        <div style="display: table-cell; width: 50%; font-size: 14px; font-weight: bold;">
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 40%; font-size: 14px; font-weight: bold;">
           First Year
        </div>
        <div style="display: table-cell; width: 50%; font-weight: bold; font-size: 14px;">
            Second Year
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            Principal <div style="width: 70%; border-bottom: 1px solid black;float: right; height: 20px;">
                {{ isset($yearlyBalances[0]['yearlyBalance']) ? number_format($yearlyBalances[0]['yearlyBalance'], 2, '.', ',') : ' ' }}
            </div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            Principal <div style="width: 70%; border-bottom: 1px solid black;float: right; height: 20px;">
                {{ isset($yearlyBalances[1]['yearlyBalance']) ? number_format($yearlyBalances[1]['yearlyBalance'], 2, '.', ',') : ' ' }}
            </div>
        </div>
        <div style="display: table-cell; width: 15%; font-size: 14px; font-weight: bold;">
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            Interest <div style="width: 70%; border-bottom: 1px solid black;float: right; height: 20px;">
                {{ isset($yearlyBalances[0]['yearlyInterest']) ? number_format($yearlyBalances[0]['yearlyInterest'], 2, '.', ',') : ' ' }}
            </div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            Interest <div style="width: 70%; border-bottom: 1px solid black;float: right; height: 20px;">
                {{ isset($yearlyBalances[1]['yearlyInterest']) ? number_format($yearlyBalances[1]['yearlyInterest'], 2, '.', ',') : ' ' }}
            </div>
        </div>
        <div style="display: table-cell; width: 15%; font-size: 14px; font-weight: bold;">
        </div>
    </div>
    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            Total <div style="width: 70%; border-bottom: 1px solid black;float: right; height: 20px;">
                {{ isset($yearlyBalances[0]['yearlyBalance']) ? number_format($yearlyBalances[0]['yearlyBalance'] + $yearlyBalances[0]['yearlyInterest'], 2, '.', ',') : ' ' }}
            </div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            Total <div style="width: 70%; border-bottom: 1px solid black;float: right; height: 20px;">
                {{ isset($yearlyBalances[1]['yearlyBalance']) ? number_format($yearlyBalances[1]['yearlyBalance'] + $yearlyBalances[1]['yearlyInterest'], 2, '.', ',') : ' ' }}
            </div>
        </div>
        <div style="display: table-cell; width: 15%; font-size: 14px; font-weight: bold;">
        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 10px;">
        <div style="display: table-cell; width: 10%;">

        </div>
        <div style="display: table-cell; width: 40%; font-size: 14px; font-weight: bold;">
           Third Year
        </div>
        <div style="display: table-cell; width: 50%; font-weight: bold; font-size: 14px;">
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            Principal <div style="width: 70%; border-bottom: 1px solid black;float: right; height: 20px;">
                {{ isset($yearlyBalances[3]['yearlyBalance']) ? number_format($yearlyBalances[3]['yearlyBalance'], 2, '.', ',') : ' ' }}
            </div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
        </div>
        <div style="display: table-cell; width: 15%; font-size: 14px; font-weight: bold;">
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            Interest <div style="width: 70%; border-bottom: 1px solid black;float: right; height: 20px;">
                {{ isset($yearlyBalances[3]['yearlyInterest']) ? number_format($yearlyBalances[3]['yearlyInterest'], 2, '.', ',') : ' ' }}
            </div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
        </div>
        <div style="display: table-cell; width: 15%; font-size: 14px; font-weight: bold;">
        </div>
    </div>

    <div style="display: table; width: 100%;">
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            Total <div style="width: 70%; border-bottom: 1px solid black;float: right; height: 20px;">
                {{ isset($yearlyBalances[2]['yearlyBalance']) ? number_format($yearlyBalances[2]['yearlyBalance'] + $yearlyBalances[2]['yearlyInterest'], 2, '.', ',') : ' ' }}
            </div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
        </div>
        <div style="display: table-cell; width: 15%; font-size: 14px; font-weight: bold;">
        </div>
    </div>

    <div style="border-bottom: 2px solid black; margin-top: 30px;"></div>

    <div style="display: table; width: 100%; margin-top: 15px;">
        <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
            Processed by:
        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            <div style="border-bottom: 1px solid black;height: 20px;"></div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            Date <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;"></div>
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
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
        </div>
        <div style="display: table-cell; width: 10%; font-size: 14px; font-weight: bold;">
        </div>
    </div>

    <div style="display: table; width: 100%; margin-top: 25px;">
        <div style="display: table-cell; width: 25%; font-weight: bold; font-size: 14px;">
            Approved by:
        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            <div style="border-bottom: 1px solid black;height: 20px;"></div>
        </div>
        <div style="display: table-cell; width: 10%; font-weight: bold;">

        </div>
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
            Date <div style="width: 80%; border-bottom: 1px solid black;float: right; height: 20px;"></div>
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
        <div style="display: table-cell; width: 30%; font-size: 14px; font-weight: bold;">
        </div>
        <div style="display: table-cell; width: 10%; font-size: 14px; font-weight: bold;">
        </div>
    </div>

        <div style="font-size: 12px; font-weight: bold; margin-top: 30px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I acknowledge receipt of a copy of this MULTI-PURPOSE LOAN computation prior to the consummation of loan/credit transaction and that I fully understand and agree to the terms and conditions thereof.
        </div>

        <div style="tab-size: 8;font-size: 12px; font-weight: bold; margin-top: 15px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Furthermore, I authorize the BU Provident Fund, Inc. to obtain access of my payroll information from the BU Accounting office to verify my credit worthiness upon application and to review my paying capacity in case of default or failure to pay the monthly amortization of this loan.
        </div>

        <div style="display: table; width: 100%; margin-top: 35px;">
            <div style="display: table-cell; width: 5%; font-weight: bold; font-size: 14px;">
            </div>
            <div style="display: table-cell; width: 45%; text-align:center; border-bottom: 1px solid black; height: 20px; text-transform: uppercase;">
                {{$firstname}}
                @if($middle_initial != null)
                {{$middle_initial}}.
                @endif
                {{$lastname}}
            </div>
            <div style="display: table-cell; width: 5%; font-size: 14px; font-weight: bold;">
            </div>
            <div style="display: table-cell; width: 40%; text-align: center; border-bottom: 1px solid black; height: 20px; text-transform: uppercase;">
                {{$co_firstname}}
                @if($co_middle_initial != null)
                    {{$co_middle_initial}}.
                @endif
                {{$co_lastname}}
            </div>
            <div style="display: table-cell; width: 5%; font-size: 14px; font-weight: bold;">
            </div>
        </div>

        <div style="display: table; width: 100%;">
            <div style="display: table-cell; width: 5%; font-weight: bold; font-size: 14px;">
            </div>
            <div style="display: table-cell; width: 45%; font-weight: bold; text-align: center; font-size: 12px;">
                Signature over printed name of Principal Borrower
            </div>
            <div style="display: table-cell; width: 5%; font-size: 14px; font-weight: bold;">
            </div>
            <div style="display: table-cell; width: 40%; font-weight: bold;text-align: center;  font-size: 12px;">
                Signature over printed name of Co-Borrower
            </div>
            <div style="display: table-cell; width: 5%; font-size: 14px; font-weight: bold;">
            </div>
        </div>

        <div style="font-size: 12px;font-weight: bold; text-align: center; width: 100%; margin-top: 30px;position: absolute;
    bottom: 0;">
        Page 2
    </div>

    <div class="page_break"></div>

    <div style="width: 100%; position:">
        <div class="new-roman" style="width: 75%; font-weight: bold; font-size: 13px; text-align: center; margin: auto;">
            NON-NEGOTIABLE PROMISSORY NOTE <br> WITH DEED OF ASSIGNMENT
        </div>
    </div>

    <div class="new-roman" style="width: 100%; font-size: 13px; font-weight: bold; margin-top: 10px;">
        PRINCIPAL BORROWER
    </div>

    <div style="display: table; width: 100%; margin-top: 5px; font-size: 15px">
        <div style="display: table-cell; width: 35%;">
            Php: <u>{{$amount_requested}}</u>
        </div>
        <div style="display: table-cell; width: 35%;">

        </div>
        <div style="display: table-cell; width: 30%;">
            Date: <u>{{$currentdate}}</u>
        </div>
    </div>

    <div style="margin-top: 10px; font-size: 13px;text-align: justify; line-height: 1.2; text-indent: 2rem;">
        For value received, I <u>{{$firstname}} {{$middle_initial}}. {{$lastname}}</u> (the "Principal Borrower"), an employee of Bicol University (the "University") and a member of the BU Provident Fund, Inc. (the "BUPFI"), promise to pay to the BU PFI the sum of the Philippine PESOS:
        <span style="border-bottom: 1px solid black">
            {{$loanAmountWord}}
        </span> (Php
        <span style="border-bottom:1px solid black;">
            {{number_format($loan->principal_amount + $loan->interest, 2, '.',',')}}
        </span>
        ) in monthly installments of Php <span style="border-bottom: 1px solid black;">
            {{number_format($monthlyAmort, 2, '.',',')}}
        </span> each starting on <span style="border-bottom: 1px solid black;">
            {{$amortStart}}
        </span> and thereafter on every corresponding date of the succeeding agreed installment period with interest thereon of <span style="border-bottom: 1px solid black">
            6%
        </span> per annum until fully paid, subject to the terms and conditions prescribed by the BU PFI.
    </div>

    <div style="margin-top: 7px; font-size: 13px;text-align: justify; line-height: 1.2; text-indent: 2rem;">
        For the payment of all installments and amounts due and demandable under the Promissory Note, I hereby assign and transfer an amount equivalent to the said monthly installment the salaries, wages, allowances and other benefits payable to me by the University.
    </div>

    <div style="margin-top: 7px; font-size: 13px; text-align: justify; line-height: 1.2; text-indent: 2rem;">
        I do hereby grant the BUPF, its management assign the full power and authority to deduct, withhold, collect and receive and give acquintance for the same or any part thereof, in may name of otherwise.
    </div>

    <div style="display: table; width: 100%; margin-top: 5px; font-size: 13px; margin-top: 20px;">
        <div style="display: table-cell; width: 40%; border-bottom: 1px solid black; height: 18px; text-align: center; text-transform: uppercase;">
            {{$firstname}}
            @if($middle_initial != null)
            {{$middle_initial}}.
            @endif
            {{$lastname}}
        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-weight: bold; font-size: 13px;">
            CONFORME:
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 13px;">
        <div style="display: table-cell; width: 40%; font-size: 13px; text-align: center; font-weight: bold;">
            Principal Borrower
        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-weight: bold; font-size: 13px; padding-left: 50px;">
            BU PROVIDENT FUND INC.
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 13px; ">
        <div style="display: table-cell; width: 40%; font-size: 13px; text-align: center;font-weight: bold;">
            Signature over printed name
        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-weight: bold; font-size: 13px; ">
            By:
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 13px; margin-top: 18px;">
        <div style="display: table-cell; width: 40%; font-size: 13px; text-align: center;">

        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-size: 13px; padding-left: 50px;">
            _______________________________
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 13px;">
        <div style="display: table-cell; width: 40%; font-size: 13px; text-align: center;">

        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-size: 13px;text-align: center; padding-left: 50px;font-weight: bold;">
            Executive Director
        </div>
    </div>

    <div style="margin-top: 10px; font-size: 13px; font-weight: bold;" class="new-roman">
        CO-BORROWER
    </div>

    <div style="margin-top: 12px; font-size: 13px; line-height: 1.2; text-indent: 2rem;">
        I, <u>{{$co_firstname}} {{$co_middle_initial}}. {{$co_lastname}}</u> (the "Principal Borrower"), an employee of Bicol University (the "University"), and a member of the BU provident Fund, Inc. (the "BUPFI"), do hereby promise, in the event of default or none payment by the Principal Borrower abovementioned, to pay the BU PFI, the whole sum remaining unpaid under this Promissory Note, Inclusive of interests, penalties or surcharges, in accordance with the terms and conditions hereof and of the Implementing Guidelines/Rules and Regulations for the Loan.
    </div>

    <div style="margin-top: 7px; font-size: 13px; line-height: 1.2; text-indent: 2rem;">
        For purposes of payment, I hereby authorize the BU PFI, upon Notice to set off, apply to the payment of, or otherwise give acquaintance for, the remaining unpaid balance of this Promissory Note, the equivalent amount from any and all salaries, wages, allowances and benefits payable to me.
    </div>

    <div style="display: table; width: 100%; margin-top: 5px; font-size: 13px; margin-top: 20px;">
        <div style="display: table-cell; width: 40%; border-bottom: 1px solid black; height: 18px;  text-align: center; text-transform: uppercase;">
            {{$co_firstname}}
            @if($co_middle_initial != null)
            {{$co_middle_initial}}.
            @endif
            {{$co_lastname}}
        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-weight: bold; font-size: 13px;">
            CONFORME:
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 13px;">
        <div style="display: table-cell; width: 40%; font-size: 13px; text-align: center; font-weight: bold;">
            Co-Borrower
        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-weight: bold; font-size: 13px; padding-left: 50px;">
            BU PROVIDENT FUND INC.
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 13px; ">
        <div style="display: table-cell; width: 40%; font-size: 13px; text-align: center;font-weight: bold;">
            Signature over Printed Name
        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-weight: bold; font-size: 13px; ">
            By:
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 13px; margin-top: 15px;">
        <div style="display: table-cell; width: 40%; font-size: 13px; text-align: center;">

        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-size: 13px; padding-left: 50px;">
            _______________________________
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 13px;">
        <div style="display: table-cell; width: 40%; font-size: 13px; text-align: center;">

        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; width: 45%; font-size: 13px;text-align: center; padding-left: 50px; font-weight: bold;">
            Executive Director
        </div>
    </div>

    <div style="width: 100%;font-weight: bold; text-align: center; font-size: 13px; margin-top: 5px;">
        Signed in the Presence of
    </div>

    <div style="display: table; width: 100%; font-size: 14px; margin-top: 15px;">
        <div style="display: table-cell; width: 40%; border-bottom: 1px solid black; font-size: 14px; text-align: center; text-transform: uppercase;">
            @if(isset($witnesses[0]) && $witnesses[0] != null)
                {{ $witnesses[0] }}
            @endif
        </div>
        <div style="display: table-cell; width: 20%;">

        </div>
        <div style="display: table-cell; width: 40%; border-bottom: 1px solid black; font-size: 14px; text-align: center; text-transform: uppercase;">
            @if(isset($witnesses[1]) && $witnesses[1] != null)
                {{ $witnesses[1] }}
            @endif
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 13px;">
        <div style="display: table-cell; width: 40%; font-size: 13px; font-weight: bold; text-align: center;">
            Witness
        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; font-weight: bold; text-align: center;width: 45%; font-size: 13px; padding-left: 50px;">
            Witness
        </div>
    </div>
    <div style="display: table; width: 100%; font-size: 13px;">
        <div style="display: table-cell; width: 40%; font-size: 13px; font-weight: bold; text-align: center;">
            Signature over Printed Name
        </div>
        <div style="display: table-cell; width: 15%;">

        </div>
        <div style="display: table-cell; font-weight: bold; text-align: center;width: 45%; font-size: 13px; padding-left: 50px;">
            Signature over Printed Name
        </div>
    </div>

    <div class="new-roman" style="width: 100%;font-weight: bold; text-align: center; font-size: 14px; margin-top: 5px;">
        ACKNOWLEDGEMENT
    </div>

    <div style="font-weight: bold; font-size: 13px; margin-top: 5px; line-height: 1.1;">
        Republic of the Philippines<br>_______________________s.s <br>X_______________________X
    </div>

    <div style="font-size: 13px; margin-top: 10px; text-indent: 2rem; line-height: 1.2;">
        BEFORE ME, a Notary Public, for the city/province of ___________________, Philippines, on this day of ____________________________, _____, personally appeared the following persons with their Community Tax Certificates as hereunder indicated.
    </div>

    <div style="display: table; width: 100%; font-size: 13px; margin-top: 10px;">
        <div style="display: table-cell; width: 40%; font-size: 13px; font-weight: bold; text-align: center;">
            Name
        </div>
        <div style="display: table-cell; width: 25%; font-size: 13px; font-weight: bold;text-align: center">
            BU ID No.
        </div>
        <div style="display: table-cell; font-weight: bold; text-align: center;width: 45%; font-size: 13px;">
            Date/Place Issued
        </div>
    </div>

    <div style="display: table; width: 100%; font-size: 13px; margin-top: 5px;">
        <div style="display: table-cell; width: 40%; font-size: 13px; font-weight: bold; text-align: center;">
            1. _______________________________
        </div>
        <div style="display: table-cell; width: 25%; font-size: 13px; font-weight: bold;text-align: center">
            __________________
        </div>
        <div style="display: table-cell; font-weight: bold; text-align: center;width: 45%; font-size: 13px;">
            ___________________________
        </div>
    </div>
    <div style="display: table; width: 100%; font-size: 13px; margin-top: 5px;">
        <div style="display: table-cell; width: 40%; font-size: 13px; font-weight: bold; text-align: center;">
            2. _______________________________
        </div>
        <div style="display: table-cell; width: 25%; font-size: 13px; font-weight: bold;text-align: center">
            __________________
        </div>
        <div style="display: table-cell; font-weight: bold; text-align: center;width: 45%; font-size: 13px;">
            ___________________________
        </div>
    </div>
    <div style="display: table; width: 100%; font-size: 13px; margin-top: 5px;">
        <div style="display: table-cell; width: 40%; font-size: 13px; font-weight: bold; text-align: center;">
            3. _______________________________
        </div>
        <div style="display: table-cell; width: 25%; font-size: 13px; font-weight: bold;text-align: center">
            __________________
        </div>
        <div style="display: table-cell; font-weight: bold; text-align: center;width: 45%; font-size: 13px;">
            ___________________________
        </div>
    </div>

    <div style="margin-top: 5px; font-size: 13px;text-align: justify; line-height: 1.2;">
        Known to me and to me known to be the same persons who executed the foregoing instrument and they acknowledged to me the same in their free and voluntary act and deed and that of the entity represented.
    </div>

    <div style="margin-top: 10px; font-size: 13px; font-weight: bold;">
        WITNESS MY HAND AND SEAL on this day __________ day of ___________, ___________ at ___________________.
    </div>

    <div style="display: table; width: 100%; font-size: 13px; margin-top: 5px;">
        <div style="display: table-cell; width: 40%; font-size: 13px; font-weight: bold;">
            Doc. No. ___________________
        </div>
        <div style="display: table-cell; width: 25%; font-size: 13px; font-weight: bold;text-align: center">
            NOTARY PUBLIC
        </div>
        <div style="display: table-cell; font-weight: bold; text-align: center;width: 45%; font-size: 13px;">

        </div>
    </div>
    <div style="font-weight: bold; font-size: 13px;">
        Page No. ___________________ <br> Book No. ___________________ <br> Series of ___________________
    </div>

    <div style="font-size: 12px;font-weight: bold; text-align: center; width: 100%; position: absolute;
    bottom: 0;">
        Page 3
    </div>
</body>
</html>

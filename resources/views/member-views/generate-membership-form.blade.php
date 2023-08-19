<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .toBold {
            font-weight: bold;
        }

        .header {
            display: table;
            width: 100%;
            height: auto;
        }

        .row1 {
            text-align: right;
            font-size: 12px;
        }

        .row2 {
            display: table;
            width: 100%;
            margin-top: 10px;
        }

        .logo {
            display: table-cell;
            vertical-align: middle;
            width: 20%;
        }

        .center-text {
            display: table-cell;
            text-align: center;
            font-weight: bold;
            vertical-align: middle;
            width: 55%;
        }

        .right-corner img {
            display: table-cell;
            width: 25%;
        }

        .ted {
            width: 100%;
            font-size: 12px;
            margin-top: 15px;
        }

        .left-column {
            margin-bottom: 10px;
        }

        .clear-float {
            font-size: 12px;
            display: table;
            width: 100%;
            clear: both;
        }

        .name {
            display: table-cell;
            width: 55%;
        }

        .sex {
            display: table-cell;
            width: 45%;
        }

        .adp {
            font-size: 12px;
            display: table;
            width: 100%;
        }

        .age {
            display: table-cell;
            width: 10%;
        }

        .dob {
            display: table-cell;
            width: 45%;
        }

        .pob {
            display: table-cell;
            width: 45%;
        }

        .unit-campus {
            font-size: 12px;
            display: table;
            width: 100%;
        }

        .unit {
            display: table-cell;
            width: 55%;
        }

        .campus {
            display: table-cell;
            width: 45%;
        }

        .pos-sal {
            font-size: 12px;
            display: table;
            width: 100%;
        }

        .position {
            display: table-cell;
            width: 55%;
        }

        .salary {
            display: table-cell;
            width: 45%;
        }

        .black-contri {
            font-size: 12px;
            display: table;
            width: 100%;
        }

        .black {
            display: table-cell;
            width: 45%;
        }

        .contribution {
            display: table-cell;
            width: 55%;
        }

        .appoints {
            font-size: 12px;
            display: table;
            width: 100%;
        }

        .status-of-appoint {
            display: table-cell;
            width: 45%;
        }

        .date-of-appoint {
            display: table-cell;
            width: 55%;
        }



        .agreement {
            margin-left: 30px;
            font-weight: bold;
            font-size: 12px;
        }

        .signature {
            margin-top: 30px;
            display: table;
            width: 100%;
        }

        .mysignature {
            font-size: 12px;
            font-weight: bold;
            display: table-cell;
            width: 35%;
            text-align: center;
            float: right;
            border-top: 1px solid black;
        }

        .threesignature {
            border-collapse: separate;
            border-spacing: 30px 0;
            margin-top: 30px;
            display: table;
            width: 100%;
        }

        .hrmo {
            display: table-cell;
            border-top: 1px solid black;
            width: 20%;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }

        .fundmanager {
            display: table-cell;
            width: 30%;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            border-top: 1px solid black;
        }

        .sigdate {
            width: 20%;
            display: table-cell;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            border-top: 1px solid black;
        }
    </style>

</head>

<body>
    <div class="header">
        <div class="row1">
            <div class="right-corner">
                BU PFI FORM No. 01 <br>March 2006
            </div>
        </div>
        <div class="row2">
            <div class="logo">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/BU-logo.png'))) }}" alt="logo" style="width:80px; height: 80px;">
            </div>
            <div class="center-text">
                BU PROVIDENT FUND, INC. <br>MEMBERSHIP FORM
            </div>
            <div class="right-corner" style="aposition: relative; text-align: right;">
                <img src="{{ $profile_picture }}" alt="default picture" style="transform: rotate(0deg); width: 85%; height: 150px;">
            </div>
        </div>
    </div>

    <div class="ted">
        <div style="width: 45%; float: right;">
            <div class="text-column">
                <span class="toBold">TIN:</span> <span>{{$tin_num}}</span>
            </div>
            <div class="text-column">
                <span class="toBold">EMPLOYEE NO.:</span> <span>{{$employee_num}}</span>
            </div>
            <div class="text-column">
                <span class="toBold">DATE of Membership:</span> <span>{{$currentdate}}</span>
            </div>
        </div>
    </div>

    <div class="clear-float">
        <div class="name">
            <span class="toBold">NAME:</span> <span>{{$lastname}}, {{$firstname}} {{$middle_initial}}.</span>
        </div>
        <div class="sex">
            <span class="toBold">SEX:</span> <span>{{ucfirst($sex)}}</span>
        </div>
    </div>

    <div class="adp">
        <div class="age">
            <span class="toBold">AGE:</span> <span>{{$age}}</span>
        </div>
        <div class="dob">
            <span class="toBold">DATE OF BIRTH:</span> <span>{{$date_of_birth}}</span>
        </div>
        <div class="pob">
            <span class="toBold">PLACE OF BIRTH:</span> <span>{{$place_of_birth}}</span>
        </div>
    </div>

    <div class="unit-campus">
        <div class="unit">
            <span class="toBold">COLLEGE/UNIT: </span> <span>{{$unit}}</span>
        </div>
        <div class="campus">
            <span class="toBold">CAMPUS:</span> <span>{{$campus}}</span>
        </div>
    </div>

    <div class="pos-sal">
        <div class="position">
            <span class="toBold">POSITION: </span> <span>{{ ucfirst($position) }}</span>
        </div>
        <div class="salary">
            <span class="toBold">MONTHLY SALARY:</span> <span>{{$monthly_salary}}</span>
        </div>
    </div>

    <div class="black-contri">
        <div class="blank">
            <span></span>
        </div>
        <div class="contribution">
            <span class="toBold">FIXED MONTHLY CONTRIBUTION:</span> <span>{{$monthly_contribution}}</span>
        </div>
    </div>

    <div class="black-contri">
        <div class="blank">
            <span></span>
        </div>
        <div class="contribution">
            <span class="toBold">OR % CONT. BASED ON MONTHLY SALARY:</span> <span></span>
        </div>
    </div>

    <div class="appoints">
        <div class="status-of-appoint">
            <span class="toBold">STATUS OF APPOINTMENT: </span> <span> {{ ucfirst($appointment_status) }}</span>
        </div>
        <div class="date-of-appoint">
            <span class="toBold">DATE OF ORIGINAL APPOINT W/ BU:</span> <span>{{$bu_appointment_date}}</span>
        </div>
    </div>

    <div class="appoints">
        <div class="status-of-appoint">
            <span class="toBold">ADDRESS: </span> <span>{{$address}}</span>
        </div>
        <div class="date-of-appoint">
            <span class="toBold">TEL./CP NO.:</span> <span>{{$contact_num}}</span>
        </div>
    </div>

    <div class="appoints">
        <div class="status-of-appoint">
            <span class="toBold">CIVIL STATUS: </span> <span> {{ ucfirst($civil_status) }}</span>
        </div>
        <div class="date-of-appoint">
            <span class="toBold">If Married, Name of Spouse:</span> <span>{{$spouse}}</span>
        </div>
    </div>

    <table class="benefeciaries" style="width: 100%; margin-top: 10px;">
        <thead>
            <tr>
                <th class="benefeciaryname" style="width: 35%;text-align: center;font-size:12px;">Name of beneficiaries</th>
                <th class="dateofbirth" style="width: 25%;text-align: center;font-size:12px;">Date of Birth</th>
                <th class="relationship" style="width: 40%;text-align: center;font-size:12px;">Relationship to Applicant</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($beneficiaries as $beneficiary)
            <tr class="listofbeneficiary">
                <td class="benefeciaryname" style="text-align: center;font-size:12px;">{{$beneficiary->beneficiary_name}}</td>
                <td class="dateofbirth" style="text-align: center;font-size:12px;">{{$beneficiary->birthday}}</td>
                <td class="relationship" style="text-align: center;font-size:12px;">{{$beneficiary->relationship}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <p class="agreement" style="margin-top: 15px; margin-bottom: 10px;">I hereby certify that all the information given above are true and correct.</p>
    <p class="agreement">Further, I hereby authorize the Administrative/Payroll Section to deduct from my salaries <br> my monthly contribution as member to the BU Provident Fund, Inc.</p>

    <div class="signature">
        <div class="black">
        </div>
        <div class="mysignature">
            Signature
        </div>
    </div>

    <p>********************************************************************************************************************</p>
    <div style="width: 100%; font-weight: bold; text-align: center; margin-top: -28px;">
        CERTIFICATION OF APPROVAL BY FUND MANAGER
    </div>
    <div style="width: 100%; margin-top: 10px; font-size: 12px;">
        Personal Clearance: <span style="margin-left: 30px;">APPROVED</span>
    </div>

    <div class="threesignature">
        <div class="hrmo">
            BU HRMO
        </div>
        <div class="fundmanager">
            Fund Manager
        </div>
        <div class="sigdate">
            Date
        </div>
    </div>

    <div style="margin-top: 10px; font-size: 12px; font-weight: bold;">
        <p>Membership takes effect upon: <br>
            <span style="margin-left: 30px;">1. Approval by the Board of Trustees <br></span>
            <span style="margin-left: 30px;">2. Initial Payment</span>
        </p>
    </div>
    <div style="width: 100%;">
        <p style="float: right; margin-right: 20px; font-size: 12px; font-weight: bold;">Fund Manager's Copy</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>

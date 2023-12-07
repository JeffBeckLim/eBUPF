<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body, table, td {
        font-family: 'Montserrat', sans-serif;
        }
        .mytable {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            font-size: 12px;
        }
        .mytable-head {
            border: 1px solid black;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .mytable-head td {
            border: 1px solid black;
        }
        .mytable-body {
            border: 1px solid black;
            border-top: 0;
            margin-top: 0;
            padding-top: 0;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .mytable-body td {
            border: 1px solid black;
            border-top: 0;
        }
        .mytable-footer {
            border: 1px solid black;
            border-top: 0;
            margin-top: 0;
            padding-top: 0;
        }
        .mytable-footer td {
            border: 1px solid black;
            border-top: 0;
        }
    </style>
</head>
<body>
    <div style="font-size: 20px; font-weight: bold;">
        Debtor's Application
    </div>
    <div style="margin-top: 10px;">
        <div style="font-size: 12px; text-align:justify;">
            In this application, you and your refer to the person being insured while we, us, our and the "BUPFI" refer to the Bicol University Provident Fund, Inc.
        </div>
        <div style="font-size: 12px; margin-top: 3px;">
            Please WRITE legibly. Indicate N/A if question is not applicable.
        </div>
    </div>

    <div style="width: 100%;">
        <table style="width: 100%; font-size: 13px;">
            <tr>
                <td style="width: 10px; padding: 0 5px; color: white; background-color: black; border: 1px solid black; margin: 0 4px 0 0;">1</td>
                <td style="color: white; background-color: black; padding: 0 0 0 10px;">General Information</td>
            </tr>
        </table>
    </div>

    <div style="width: 100%;">
        <table style="width: 100%;">
            <tr style="font-size: 13px;">
                <td style="width: 15%;"></td>
                <td style="width: 15%;">For:</td>
                <td style="width: 30%;">
                    <label style="display: inline-block; vertical-align: middle;">
                        <input type="checkbox" name="checkbox1" value="option1" style="vertical-align: middle;"> New Application
                    </label>
                </td>
                <td style="width: 40%;">
                    <label style="display: inline-block; vertical-align: middle;">
                        <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;"> Reinstatement
                    </label>
                </td>
            </tr>
        </table>
    </div>

    <div style="font-size: 13px; padding-left: 5px; margin-bottom: 2px;">
        Relating to Debtor
    </div>

    <table class="mytable mytable-head">
        <tr>
            <td width="35%" style="border: none; padding-left: 10px;">
                Last Name <br>
                <div style="margin: 7px 10px;">
                    <span style="font-size: 14px;">{{$lastname}}</span>
                </div>
            </td>
            <td width="45%"  style="border: none;">
                First Name <br>
                <div style="margin: 7px 10px;">
                    <span style="font-size: 14px;">{{$firstname}}</span>
                </div>
            </td>
            <td width="20%" style="border: none;">
                Middle Name <br>
                <div style="margin: 7px 10px;">
                    <span style="font-size: 14px;">{{$middlename}}</span>
                </div>
            </td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="40%" style="vertical-align: top; padding-left: 10px;">Other Legal Names (a.k.a)</td>
            <td width="15%">
                <label style="display: inline-block; vertical-align: middle;">
                    <input type="checkbox" name="checkbox1" value="Male" style="vertical-align: middle;" {{ $sex == 'male' ? 'checked' : '' }}> Male
                </label> <br>
                <label style="display: inline-block; vertical-align: middle;">
                    <input type="checkbox" name="checkbox1" value="Female" style="vertical-align: middle;" {{ $sex == 'female' ? 'checked' : '' }}> Female
                </label>
            </td>
            <td width="45%"></td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="30%">
                <div style="padding-left: 10px; padding-top: 2px;">
                    <label style="display: inline-block; vertical-align: middle;">
                    <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;" {{ $civilStatus == 'single' ? 'checked' : '' }}> Single
                    </label>
                    <label style="display: inline-block; vertical-align: middle;">
                        <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;" {{ $civilStatus == 'married' ? 'checked' : '' }}> Married
                    </label>
                    <label style="display: inline-block; vertical-align: middle;">
                        <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;" {{ $civilStatus == 'widowed' ? 'checked' : '' }}> Widowed
                    </label>
                    <label style="display: inline-block; vertical-align: middle;">
                        <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;" {{ $civilStatus == 'divorced' ? 'checked' : '' }}> Divorced
                    </label>
                    <label style="display: inline-block; vertical-align: middle;">
                        <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;" {{ $civilStatus == 'separated' ? 'checked' : '' }}> Separated
                    </label>
                </div>
            </td>
            <td width="25%" style="vertical-align: top; padding-left: 10px;">
                Birthplace <br>
                <div style="margin: 7px 0 7px 10px">
                    <span style="font-size: 12px;">{{$birthPlace}}</span>
                </div>
            </td>
            <td width="25%" style="vertical-align: top; padding-left: 10px;">
                Date of Birth (Month/Day/Year)<br>
                <div style="margin: 7px 0 7px 10px">
                    <span style="font-size: 14px;">{{$dateOfBirth}}</span>
                </div>
            </td>
            <td width="20%" style="vertical-align: top; padding-left: 10px;">
                Age (last birthday) <br>
                <div style="margin: 7px 0 7px 10px">
                    <span style="font-size: 14px;">{{$age}}</span>
                </div>
            </td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="30%" style="padding-left: 10px;">
                Nationality
                <div style="padding: 7px 0 0 3px">
                    <label style="display: inline-block; vertical-align: middle;">
                        <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;" checked> Filipino
                    </label>
                    <label style="display: inline-block; vertical-align: middle;">
                        <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;"> Others, Specify
                    </label>
                </div>
            </td>
            <td width="35%" style="vertical-align: top; padding-left: 10px;">
                TIN <br>
                <div style="margin: 7px 0 7px 10px">
                    <span style="font-size: 14px;">{{$tin}}</span>
                </div>
            </td>
            <td width="35%" style="vertical-align: top; padding-left: 10px;">
                SSS No. or GSIS No. <span style="font-weight: bold; color: red;">*</span>
            </td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="100%" style="padding-left: 10px;">
                Residence Address (no., street, municipality/city, province, country, zip code) P.O. Box is not acceptable <br>
                <div style="margin: 7px 10px;">
                    <span style="font-size: 14px;">{{$address}}</span>
                </div>
            </td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="40%" style="padding-left: 10px;">
                Occupation & Office/Unit <br>
                <div style="margin: 7px 10px;">
                    <span style="font-size: 14px;">{{$position}} - BU{{$unit}}</span>
                </div>
            </td>
            <td width="25%"  style="padding-left: 10px;">
                Name of Employer <br>
                <div style="margin: 7px 10px;">
                    <span style="font-size: 14px;">{{$employer}}</span>
                </div>
            </td>
            <td width="35%" style="padding-left: 10px; vertical-align: top;">Group Policy No.</td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="100%" style="padding-bottom: 30px; padding-left: 10px;">
                Employer's Address (building, no., street, municipality/city, province, country, zip code) P.O. Box is not acceptable
            </td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="25%" style="border: none; padding-left: 10px; vertical-align: top;">Home Phone</td>
            <td width="25%"  style="border: none; vertical-align: top; vertical-align: top;">Work Phone</td>
            <td width="25%" style="border: none; vertical-align: top;">
                Mobile Phone <br>
                <div style="margin: 7px 10px;">
                    <span style="font-size: 14px;">{{$contactNumber}}</span>
                </div>
            </td>
            <td width="25%" style="border:none; vertical-align: top;">
                Email Address <br>
                <div style="margin: 7px 10px;">
                    <span style="font-size: 14px;">{{$email}}</span>
                </div>
            </td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="55%" style="padding-bottom: 30px; padding-left: 10px;">
                Amount of Indeptedness (to be completed by the Deptor)
            </td>
            <td width="45%" style="padding-bottom: 30px; padding-left: 10px;">
                Term of contact of Indeptedness (No. of years to pay)
            </td>
        </tr>
    </table>

    <div style="font-size: 13px; font-weight: bold; margin-top: 10px;">
        Beneficiary
    </div>
    <div style="font-size: 13px; margin: 4px 0;">
        Primary Beneficiary/ies
    </div>

    <table class="mytable mytable-head">
        <tr>
            <td width="40%" style="border: none; padding-bottom: 40px; padding-left: 10px;">Name (First Name, MI, Last Name)</td>
            <td width="40%"  style="border: none; padding-bottom: 40px;">Date of Birth (Month/Day/Year)</td>
            <td width="20%" style="border: none; padding-bottom: 40px;">Relationship to Insured</td>
        </tr>
    </table>

    <div style="font-size: 13px; margin: 6px 0;">
        Contingent Beneficiary in the event of death of all primary beneficiaries
    </div>

    <table class="mytable mytable-head">
        <tr>
            <td width="40%" style="border: none; padding-bottom: 30px; padding-left: 10px;">Name (First Name, MI, Last Name)</td>
            <td width="40%"  style="border: none; padding-bottom: 30px;">Date of Birth (Month/Day/Year)</td>
            <td width="20%" style="border: none; padding-bottom: 30px;">Relationship to Insured</td>
        </tr>
    </table>
    <div style="font-size: 12px; margin: 4px 0 0 20px 3px;">
        Note: All nominations of beneficiaries are revocable unless otherwise specified.
    </div>

    <div style="width: 100%; margin-top: 10px;">
        <table style="width: 100%; font-size: 13px;">
            <tr>
                <td style="width: 10px; padding: 0 5px; color: white; background-color: black; border: 1px solid black; margin: 0 4px 0 0;">2</td>
                <td style="color: white; background-color: black; padding: 0 0 0 10px;">Declaration and Representation</td>
            </tr>
        </table>
    </div>

    <div style="width: 100%;">
        <table style="width: 100%; font-size: 12px;">
            <tr>
                <td style="width: 3%; padding: 0 0 0 13px; margin: 0 4px 0 0; vertical-align: top;">1.</td>
                <td style="width: 77%;padding: 0 0 0 10px;">
                    Within the last two (2) years, have any of your applications for insurance been declined, postponed, withdrawn or accepted on a basis other than that applied for? <span style="font-weight: bold; color: red;">*</span>
                </td>
                <td style="width: 10%;">
                    <label style="display: inline-block; vertical-align: middle; padding-left: 10px;">
                        Yes <input type="checkbox" name="checkbox1" value="option1" style="vertical-align: middle;">
                    </label>
                </td>
                <td style="width: 10%;">
                    <label style="display: inline-block; vertical-align: middle;">
                        No <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;">
                    </label>
                </td>
            </tr>
        </table>
        <table style="width: 100%; font-size: 12px;">
            <tr>
                <td style="width: 3%; padding: 0 0 0 13px; margin: 0 4px 0 0; vertical-align: top;">2.</td>
                <td style="width: 77%;padding: 0 0 0 10px;">
                    Have you had any symptoms of, sought advice for, or been treated for high blood pressure, stroke, heart trouble, diabetes, cancer, or tumour, chest pain, bleeding from the bowel, or blood in your sputum, or has treatment for any of these been recommended by a physician or other practitioner? <span style="font-weight: bold; color: red;">*</span>
                </td>
                <td style="width: 10%;">
                    <label style="display: inline-block; vertical-align: middle; padding-left: 10px;">
                        Yes <input type="checkbox" name="checkbox1" value="option1" style="vertical-align: middle;">
                    </label>
                </td>
                <td style="width: 10%;">
                    <label style="display: inline-block; vertical-align: middle;">
                        No <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;">
                    </label>
                </td>
            </tr>
        </table>
        <table style="width: 100%; font-size: 12px;">
            <tr>
                <td style="width: 3%; padding: 0 0 0 13px; margin: 0 4px 0 0; vertical-align: top;">3.</td>
                <td style="width: 77%;padding: 0 0 0 10px;">
                    Within the last five (5) years, have you been admitted or been adviced to be admitted as an in-patient to ahospiital or clinic EXCEPT for pregnancy, birth, routine health check-up, gall bladder/kidney stones, colds, flu/influenza, gastroenteritis, upper and lower respiratory tract infections, hepatitis A, appendectomy, tonsillectomy, haemorrhoidectomy, cholecystectomy, and herniotomy? <span style="font-weight: bold; color: red;">*</span>
                </td>
                <td style="width: 10%;">
                    <label style="display: inline-block; vertical-align: middle; padding-left: 10px;">
                        Yes <input type="checkbox" name="checkbox1" value="option1" style="vertical-align: middle;">
                    </label>
                </td>
                <td style="width: 10%;">
                    <label style="display: inline-block; vertical-align: middle;">
                        No <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;">
                    </label>
                </td>
            </tr>
        </table>
        <table style="width: 100%; font-size: 12px;">
            <tr>
                <td style="width: 3%; padding: 0 0 0 13px; margin: 0 4px 0 0; vertical-align: top;">2.</td>
                <td style="width: 77%;padding: 0 0 0 10px;">
                    Do you have any health symptoms or complaints for which a physician has not been consulted or treatment has not been received? For example: persistent fever, unexplained weight loss, loss of appetite, pain or swelling, etc.? <span style="font-weight: bold; color: red;">*</span>
                </td>
                <td style="width: 10%;">
                    <label style="display: inline-block; vertical-align: middle; padding-left: 10px;">
                        Yes <input type="checkbox" name="checkbox1" value="option1" style="vertical-align: middle;">
                    </label>
                </td>
                <td style="width: 10%;">
                    <label style="display: inline-block; vertical-align: middle;">
                        No <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;">
                    </label>
                </td>
            </tr>
        </table>
    </div>

    <div style="font-size: 13px; font-weight: bold; margin-top: 10px;">
        Signature
    </div>

    <div style="font-size: 12px; margin-top: 5px;">
        By signing below, you declare that to the best of your knowledge and belief, the above answers and those on any attached sheet are complete and true.
    </div>

    <table class="mytable mytable-head">
        <tr>
            <td width="50%" style="padding-left: 10px;">
                Place of Signing <br>
                <div style="margin: 7px 10px;">
                    <span style="font-size: 13px;">{{$placeOfSigning}}</span>
                </div>
            </td>
            <td width="50%"  style="padding-left: 10px;">
                Date (Month/Day/Year) <br>
                <div style="margin: 7px 10px;">
                    <span style="font-size: 14px;">{{$currentdate}}</span>
                </div>
            </td>
        </tr>
    </table>
    <table class="mytable mytable-body">
        <tr>
            <td width="50%" style="padding-left: 10px; vertical-align: top;">Your Signature <span style="font-weight: bold; color: red;">*</span></td>
            <td width="50%"  style="padding-left: 10px;">Printed Name <br>
                <div style="margin: 7px 10px;">
                    <span style="font-size: 14px;">{{$firstname}} {{$middlename}} {{$lastname}}</span>
                </div>
            </td>
        </tr>
    </table>
    <table class="mytable mytable-body">
        <tr>
            <td width="50%" style="padding-bottom: 25px; padding-left: 10px;">Witness</td>
            <td width="50%"  style="padding-bottom: 25px; padding-left: 10px;">Name of Witness</td>
        </tr>
    </table>

    <div class="page_break"></div>

    <table class="mytable mytable-head" style="padding-top: 20px;">
        <tr>
            <td width="50%" style="padding-bottom: 10px; padding-left: 10px; vertical-align: top;">
                Type of Loan
                <div style="margin: 10px 0 5px 75px;">
                    <label style="display: inline-block; vertical-align: middle; padding-left: 10px;">
                        <input type="checkbox" name="checkbox1" value="option1" style="vertical-align: middle;"> Multi-Purpose Loan
                    </label> <br>
                    <label style="display: inline-block; vertical-align: middle; padding-left: 10px;">
                        <input type="checkbox" name="checkbox1" value="option1" style="vertical-align: middle;"> Housing Loan
                    </label>
                </div>
            </td>
            <td width="50%"  style="padding: 10px 0 10px 17px;">
                <div>
                    <label style="display: inline-block; vertical-align: middle; padding-left: 10px;">
                        <input type="checkbox" name="checkbox1" value="option1" style="vertical-align: middle;"> New
                    </label> <br>
                    <label style="display: inline-block; vertical-align: middle; padding-left: 10px;">
                        <input type="checkbox" name="checkbox1" value="option1" style="vertical-align: middle;"> Renewal
                    </label> <br>
                    <label style="display: inline-block; vertical-align: middle; padding-left: 10px;">
                        <input type="checkbox" name="checkbox1" value="option1" style="vertical-align: middle;"> Additional
                    </label>
                </div>
            </td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="50%" style="padding-bottom: 35px; padding-left: 10px;">Amount of Loan Granted</td>
            <td width="50%"  style="padding-bottom: 35px; padding-left: 10px;">Term of Loan (No. of years to pay)</td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="50%" style="padding-bottom: 30px; padding-left: 10px;">
                Monthly Amortization
                <div style="padding: 10px 0 0 50px; line-height:2.3; ">
                    Principal: _____________________
                    <br>
                    Interest: &nbsp; _____________________
                    <br>
                    <span>
                        Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; _____________________
                    </span>
                </div>
            </td>
            <td width="50%"  style="padding-bottom: 30px; padding-left: 10px; vertical-align: top;">
                Amortization/Collection Period:
                <div style="padding: 10px 0 0 0; line-height: 2.3;">
                    Start: ___________________________
                    <br>
                    End: _____________________________
                </div>
            </td>
        </tr>
    </table>

    <div style="margin: 40px 0 40px 0; font-size: 12px; line-height: 1.6;">
        You understand and agree that your insurance shall become effective in accordance with the terms and conditions of the Bicol University Provident Fund, Inc. for which this application is made provided that you are Active-At-Work on such date. <br>
        You also understand and agree taht while insured under the Bicol University Provident Fund, Inc., the Amount of Insurance in force at the time of your death shall be used to discharge you of your Outstanding Indeptedness to the Creditor <b>as long as you ensure religious and sufficient payment of monthly loan amortization</b>. <br>
        The excess, if any, of the amount of Insurance over your Outstanding Indeptedness shall be made payable to your beneficiaries <br>
        You allow us to process and disclose your personal and sensitive personal information to third parties so that we can better help you meet your lifetime needs. <br>
        If you need more information about our policy, term and conditions, please visit us in our office.
    </div>

    <table class="mytable mytable-body" style="border: none !important;">
        <tr>
            <td width="3%" style="border: none; padding-bottom: 35px; padding-left: 10px; vertical-align: top:">
                <input type="checkbox" name="checkbox1" value="option1">
            </td>
            <td width="97%" style="border: none; padding-bottom: 35px; padding-left: 10px; line-height: 1.6;">
                <span style="font-weight: bold; color: red;">*</span> Yes, I understand the Terms and Conditions of Bicol University Provident Fund, Inc. <br>
                I declare that I am between 18 to 64 years old, physically and mentally healthy, have never been hospitalized, nor treated for any illness in the past 12 months, and actively performing my normal daily activities. <br>
                I authorize the BUPFI to process any relevant personal information on me and/or my loan with BUPFI and to disclose such personal information to their affiliated third persons, entity or entities providing services on their behalf, to enable them to evaluate and assess my application as well as to service my policy or policies and other insurance needs.
            </td>
        </tr>
    </table>

    <div style="margin-bottom: 10px; font-size: 12px; line-height: 1.6;">
        By signing below, I hereby confirm my enrolment to the terms and conditions of Bicol University Provident Fund, Inc. and that all information indicated above are true and correct.
    </div>

    <table class="mytable mytable-head">
        <tr>
            <td width="50%" style="padding-left: 10px; vertical-align:top;">Signature <span style="font-weight: bold; color: red;">*</span></td>
            <td width="50%"  style="padding-left: 10px;">
                Printed Name <br>
                <div style="margin: 7px 10px;">
                    <span style="font-size: 14px;">{{$firstname}} {{$middlename}} {{$lastname}}</span>
                </div>
            </td>
        </tr>
    </table>
    <table class="mytable mytable-body">
        <tr>
            <td width="50%" style="padding-left: 10px;">
                Place of Signing <br>
                <div style="margin: 7px 10px;">
                    <span style="font-size: 13px;">{{$placeOfSigning}}</span>
                </div>
            </td>
            <td width="50%"  style="padding-left: 10px;">
                Date (Month/Day/Year) <br>
                <div style="margin: 7px 10px;">
                    <span style="font-size: 14px;">{{$currentdate}}</span>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>

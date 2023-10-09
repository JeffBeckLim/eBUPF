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
    <div style="font-size: 20px; font-weight: bold; margin-bottom: 1px;">
        Debtor's Application
    </div>
    <div style="margin-top: 15px;">
        <div style="font-size: 12px; text-align:justify;">
            In this application, you and your refer to the person being insured while we, us, our and the "BUPFI" refer to the Bicol University Provident Fund, Inc.
        </div>
        <div style="font-size: 12px; margin-top: 5px;">
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

    <div style="font-size: 13px; margin-top: 1px; padding-left: 5px;">
        Relating to Debtor
    </div>

    <table class="mytable mytable-head">
        <tr>
            <td width="35%" style="border: none; padding-bottom: 30px; padding-left: 10px;">Last Name</td>
            <td width="45%"  style="border: none; padding-bottom: 30px;">First Name</td>
            <td width="20%" style="border: none; padding-bottom: 30px;">Middle Name</td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="40%" style="vertical-align: top; padding-left: 10px;">Other Legal Names (a.k.a)</td>
            <td width="15%">
                <label style="display: inline-block; vertical-align: middle;">
                    <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;"> Male
                </label> <br>
                <label style="display: inline-block; vertical-align: middle;">
                    <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;"> Female
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
                    <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;"> Single
                    </label>
                    <label style="display: inline-block; vertical-align: middle;">
                        <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;"> Married
                    </label>
                    <label style="display: inline-block; vertical-align: middle;">
                        <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;"> Widowed
                    </label>
                    <label style="display: inline-block; vertical-align: middle;">
                        <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;"> Divorced
                    </label>
                    <label style="display: inline-block; vertical-align: middle;">
                        <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;"> Separated
                    </label>
                </div>
            </td>
            <td width="25%" style="vertical-align: top; padding-left: 10px;">
                Birthplace
            </td>
            <td width="25%" style="vertical-align: top; padding-left: 10px;">Date of Birth (Month/Day/Year)</td>
            <td width="20%" style="vertical-align: top; padding-left: 10px;">Age (last birthday)</td>
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
                TIN
            </td>
            <td width="35%" style="vertical-align: top; padding-left: 10px;">
                SSS No. or GSIS No.
            </td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="100%" style="padding-bottom: 30px; padding-left: 10px;">
                Residence Address (no., street, municipality/city, province, country, zip code) P.O. Box is not acceptable
            </td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="40%" style="padding-bottom: 30px; padding-left: 10px;">Occupation & Office/Unit</td>
            <td width="25%"  style="padding-bottom: 30px; padding-left: 10px;">Name of Employer</td>
            <td width="35%" style="padding-bottom: 30px; padding-left: 10px;">Group Policy No.</td>
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
            <td width="25%" style="border: none; padding-bottom: 30px; padding-left: 10px;">Home Phone</td>
            <td width="25%"  style="border: none; padding-bottom: 30px;">Work Phone</td>
            <td width="25%" style="border: none; padding-bottom: 30px;">Mobile Phone</td>
            <td width="25%" style="border:none; padding-bottom:30px;">Email Address</td>
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

    <div style="font-size: 13px; font-weight: bold; margin-top: 7px;">
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
                <td style="width: 75%;padding: 0 0 0 10px;">
                    Within the last two (2) years, have any of your applications for insurance been declined, postponed, withdrawn or accepted on a basis other than that applied for?
                </td>
                <td style="width: 11%;">
                    <label style="display: inline-block; vertical-align: middle; padding-left: 10px;">
                        Yes <input type="checkbox" name="checkbox1" value="option1" style="vertical-align: middle;">
                    </label>
                </td>
                <td style="width: 11%;">
                    <label style="display: inline-block; vertical-align: middle;">
                        No <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;">
                    </label>
                </td>
            </tr>
        </table>
        <table style="width: 100%; font-size: 12px;">
            <tr>
                <td style="width: 3%; padding: 0 0 0 13px; margin: 0 4px 0 0; vertical-align: top;">2.</td>
                <td style="width: 75%;padding: 0 0 0 10px;">
                    Have you had any symptoms of, sought advice for, or been treated for high blood pressure, stroke, heart trouble, diabetes, cancer, or tumour, chest pain, bleeding from the bowel, or blood in your sputum, or has treatment for any of these been recommended by a physician or other practitioner?
                </td>
                <td style="width: 11%;">
                    <label style="display: inline-block; vertical-align: middle; padding-left: 10px;">
                        Yes <input type="checkbox" name="checkbox1" value="option1" style="vertical-align: middle;">
                    </label>
                </td>
                <td style="width: 11%;">
                    <label style="display: inline-block; vertical-align: middle;">
                        No <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;">
                    </label>
                </td>
            </tr>
        </table>
        <table style="width: 100%; font-size: 12px;">
            <tr>
                <td style="width: 3%; padding: 0 0 0 13px; margin: 0 4px 0 0; vertical-align: top;">3.</td>
                <td style="width: 75%;padding: 0 0 0 10px;">
                    Within the last five (5) years, have you been admitted or been adviced to be admitted as an in-patient to ahospiital or clinic EXCEPT for pregnancy, birth, routine health check-up, gall bladder/kidney stones, colds, flu/influenza, gastroenteritis, upper and lower respiratory tract infections, hepatitis A, appendectomy, tonsillectomy, haemorrhoidectomy, cholecystectomy, and herniotomy?
                </td>
                <td style="width: 11%;">
                    <label style="display: inline-block; vertical-align: middle; padding-left: 10px;">
                        Yes <input type="checkbox" name="checkbox1" value="option1" style="vertical-align: middle;">
                    </label>
                </td>
                <td style="width: 11%;">
                    <label style="display: inline-block; vertical-align: middle;">
                        No <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;">
                    </label>
                </td>
            </tr>
        </table>
        <table style="width: 100%; font-size: 12px;">
            <tr>
                <td style="width: 3%; padding: 0 0 0 13px; margin: 0 4px 0 0; vertical-align: top;">2.</td>
                <td style="width: 75%;padding: 0 0 0 10px;">
                    Do you have any health symptoms or complaints for which a physician has not been consulted or treatment has not been received? For example: persistent fever, unexplained weight loss, loss of appetite, pain or swelling, etc.?
                </td>
                <td style="width: 11%;">
                    <label style="display: inline-block; vertical-align: middle; padding-left: 10px;">
                        Yes <input type="checkbox" name="checkbox1" value="option1" style="vertical-align: middle;">
                    </label>
                </td>
                <td style="width: 11%;">
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

    <div style="font-size: 12px; margin-top: 7px;">
        By signing below, you declare that to the best of your knowledge and belief, the above answers and those on any attached sheet are complete and true.
    </div>

    <table class="mytable mytable-head">
        <tr>
            <td width="50%" style="padding-bottom: 30px; padding-left: 10px;">Place of Signing</td>
            <td width="50%"  style="padding-bottom: 30px; padding-left: 10px;">Date (Month/Day/Year)</td>
        </tr>
    </table>
    <table class="mytable mytable-body">
        <tr>
            <td width="50%" style="padding-bottom: 30px; padding-left: 10px;">Your Signature</td>
            <td width="50%"  style="padding-bottom: 30px; padding-left: 10px;">Printed Name</td>
        </tr>
    </table>
    <table class="mytable mytable-body">
        <tr>
            <td width="50%" style="padding-bottom: 30px; padding-left: 10px;">Witness</td>
            <td width="50%"  style="padding-bottom: 30px; padding-left: 10px;">Name of Witness</td>
        </tr>
    </table>

    <div class="page_break"></div>

    <table class="mytable mytable-head">
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
        You also understand and agree taht while insured under the Bicol University Provident Fund, Inc., the Amount of Insurance in force at the time of your death shall be used to discharge you of your Outstanding Indeptedness to the Creditor <b>as long as you ensure religious and sufficient payment of monthly loan amortization</b> <br>
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
                Yes, I understand the Terms and Conditions of Bicol University Provident Fund, Inc. <br>
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
            <td width="50%" style="padding-bottom: 33px; padding-left: 10px;">Signature</td>
            <td width="50%"  style="padding-bottom: 33px; padding-left: 10px;"> Printed Name</td>
        </tr>
    </table>
    <table class="mytable mytable-body">
        <tr>
            <td width="50%" style="padding-bottom: 33px; padding-left: 10px;">Place of Signing</td>
            <td width="50%"  style="padding-bottom: 33px; padding-left: 10px;">Date (Month/Day/Year)</td>
        </tr>
    </table>

</body>
</html>

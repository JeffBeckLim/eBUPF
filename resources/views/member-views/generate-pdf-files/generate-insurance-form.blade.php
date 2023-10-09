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
    <div style="font-size: 25px; font-weight: bold;">
        Debtor's Application
    </div>
    <div style="margin-top: 12px;">
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
        <table style="width: 100%; ">
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

    <div style="font-size: 13px; margin-top: 1px;">
        Relating to Debtor
    </div>

    <table class="mytable mytable-head">
        <tr>
            <td width="35%" style="border: none; padding-bottom: 30px;">Last Name</td>
            <td width="45%"  style="border: none; padding-bottom: 30px;">First Name</td>
            <td width="20%" style="border: none; padding-bottom: 30px;">Middle Name</td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="40%" style="vertical-align: top;">Other Legal Names (a.k.a)</td>
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
            </td>
            <td width="25%" style="vertical-align: top;">
                Birthplace
            </td>
            <td width="25%" style="vertical-align: top;">Date of Birth (Month/Day/Year)</td>
            <td width="20%" style="vertical-align: top;">Age (last birthday)</td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="30%">
                Nationality
                <div>
                    <label style="display: inline-block; vertical-align: middle;">
                        <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;"> Filipino
                    </label>
                    <label style="display: inline-block; vertical-align: middle;">
                        <input type="checkbox" name="checkbox1" value="option2" style="vertical-align: middle;"> Others, Specify
                    </label>
                </div>
            </td>
            <td width="35%" style="vertical-align: top;">
                TIN
            </td>
            <td width="35%" style="vertical-align: top;">
                SSS No. or GSIS No.
            </td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="100%" style="padding-bottom: 30px;">
                Residence Address (no., street, municipality/city, province, country, zip code) P.O. Box is not acceptable
            </td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="40%" style="padding-bottom: 30px;">Occupation & Office/Unit</td>
            <td width="25%"  style="padding-bottom: 30px;">Name of Employer</td>
            <td width="35%" style="padding-bottom: 30px;">Group Policy No.</td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="100%" style="padding-bottom: 30px;">
                Employer's Address (building, no., street, municipality/city, province, country, zip code) P.O. Box is not acceptable
            </td>
        </tr>
    </table>

    <table class="mytable mytable-body">
        <tr>
            <td width="25%" style="border: none; padding-bottom: 30px;">Home Phone</td>
            <td width="25%"  style="border: none; padding-bottom: 30px;">Work Phone</td>
            <td width="25%" style="border: none; padding-bottom: 30px;">Mobile Phone</td>
            <td width="25%" style="border:none; padding-bottom:30px;">Email Address</td>
        </tr>
    </table>

    <table class="mytable mytable-footer">
        <tr>
            <td width="55%" style="padding-bottom: 30px;">
                Amount of Indeptedness (to be completed by the Deptor)
            </td>
            <td width="45%" style="padding-bottom: 30px;">
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
            <td width="40%" style="border: none; padding-bottom: 40px;">Name (First Name, MI, Last Name)</td>
            <td width="40%"  style="border: none; padding-bottom: 40px;">Date of Birth (Month/Day/Year)</td>
            <td width="20%" style="border: none; padding-bottom: 40px;">Relationship to Insured</td>
        </tr>
    </table>

    <div style="font-size: 13px; margin: 6px 0;">
        Contingent Beneficiary in the event of death of all primary beneficiaries
    </div>

    <table class="mytable mytable-head">
        <tr>
            <td width="40%" style="border: none; padding-bottom: 30px;">Name (First Name, MI, Last Name)</td>
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
        <table style="width: 100%; font-size: 13px;">
            <tr>
                <td style="width: 3%; padding: 0 0 0 13px; margin: 0 4px 0 0; vertical-align: top;">1.</td>
                <td style="width: 75%;padding: 0 0 0 10px;">
                    Within the last two (2) years, have any of your applications for insurance been declined, postponed, withdrawn or accepted on a basis other than that applied for?
                </td>
                <td style="width: 11%;">
                    <label style="display: inline-block; vertical-align: middle;">
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
        <table style="width: 100%; font-size: 13px;">
            <tr>
                <td style="width: 3%; padding: 0 0 0 13px; margin: 0 4px 0 0; vertical-align: top;">2.</td>
                <td style="width: 75%;padding: 0 0 0 10px;">
                    Have you had any symptoms of, sought advice for, or been treated for high blood pressure, stroke, heart trouble, diabetes, cancer, or tumour, chest pain, bleeding from the bowel, or blood in your sputum, or has treatment for any of these been recommended by a physician or other practitioner?
                </td>
                <td style="width: 11%;">
                    <label style="display: inline-block; vertical-align: middle;">
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
        <table style="width: 100%; font-size: 13px;">
            <tr>
                <td style="width: 3%; padding: 0 0 0 13px; margin: 0 4px 0 0; vertical-align: top;">3.</td>
                <td style="width: 75%;padding: 0 0 0 10px;">
                    Within the last five (5) years, have you been admitted or been adviced to be admitted as an in-patient to ahospiital or clinic EXCEPT for pregnancy, birth, routine health check-up, gall bladder/kidney stones, colds, flu/influenza, gastroenteritis, upper and lower respiratory tract infections, hepatitis A, appendectomy, tonsillectomy, haemorrhoidectomy, cholecystectomy, and herniotomy?
                </td>
                <td style="width: 11%;">
                    <label style="display: inline-block; vertical-align: middle;">
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
        <table style="width: 100%; font-size: 13px;">
            <tr>
                <td style="width: 3%; padding: 0 0 0 13px; margin: 0 4px 0 0; vertical-align: top;">2.</td>
                <td style="width: 75%;padding: 0 0 0 10px;">
                    Do you have any health symptoms or complaints for which a physician has not been consulted or treatment has not been received? For example: persistent fever, unexplained weight loss, loss of appetite, pain or swelling, etc.?
                </td>
                <td style="width: 11%;">
                    <label style="display: inline-block; vertical-align: middle;">
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

    <div style="font-size: 10px; margin-top: 7px;">
        By signing below, you declare that to the best of your knowledge and belief, the above answers and those on any attached sheet are complete and true.
    </div>

    <table class="mytable mytable-head">
        <tr>
            <td width="50%" style="padding-bottom: 30px;">Place of Signing</td>
            <td width="50%"  style="padding-bottom: 30px;">Date (Month/Day/Year)</td>
        </tr>
    </table>
    <table class="mytable mytable-body">
        <tr>
            <td width="50%" style="padding-bottom: 30px;">Your Signature</td>
            <td width="50%"  style="padding-bottom: 30px;">Printed Name</td>
        </tr>
    </table>
    <table class="mytable mytable-body">
        <tr>
            <td width="50%" style="padding-bottom: 30px;">Witness</td>
            <td width="50%"  style="padding-bottom: 30px;">Name of Witness</td>
        </tr>
    </table>
</body>
</html>

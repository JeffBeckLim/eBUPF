<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Member;
use Carbon\Carbon;
use App\Models\Unit;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PDFController extends controller{

    public function generateMembershipForm($id)
    {

        $member = Member::find($id);
        if ($member) {
            $dateOfBirth = Carbon::parse($member->date_of_birth);
            $currentDate = Carbon::now();
            $age = $currentDate->diffInYears($dateOfBirth);
            $member_unit = Unit::with('campuses')->findOrFail($member->unit_id);
            $memberbene = Member::with('beneficiaries')->findOrFail($id);
            $beneficiaries = $memberbene->beneficiaries;

            $profilePicturePath = 'storage/' . $member->profile_picture;
            $orientedImage = Image::make($profilePicturePath)->orientate();
            $encodedImage = $orientedImage->encode('data-url')->encoded;

            $data = [
                'currentdate' => date('Y-m-d'),
                'firstname' => $member->firstname,
                'lastname' => $member->lastname,
                'middle_initial' => $member->middle_initial,
                'contact_num' => $member->contact_num,
                'address' => $member->address,
                'date_of_birth' => $member->date_of_birth,
                'tin_num' => $member->tin_num,
                'age' => $age,
                'position' => $member->position,
                'employee_num' => $member->employee_num,
                'bu_appointment_date' => $member->bu_appointment_date,
                'place_of_birth' => $member->place_of_birth,
                'civil_status' => $member->civil_status,
                'spouse' => $member->spouse,
                'sex' => $member->sex,
                'monthly_salary' => $member->monthly_salary,
                'monthly_contribution' => $member->monthly_contribution,
                'appointment_status' => $member->appointment_status,
                'profile_picture' => $encodedImage,
                'unit' => $member_unit->unit_code,
                'campus' => $member_unit->campuses->campus_code,
                'beneficiaries' => $beneficiaries,
            ];

            $pdf = PDF::loadView('member-views.generate-membership-form', $data)->setPaper('letter', 'portrait');

            return $pdf->download('Membership Application Form.pdf');

        } else {
            return redirect()->back()->with('error', 'Member not found.');
        }

    }

    public function generateMPL()
    {
        $data = [
            'lastname' => 'Labini',
            'firstname' => 'Aaron',
            'middle_initial' => 'B',
            'date_of_birth' => '2021-11-27',
            'age' => '21',
            'tin' => '4561324',
            'address' => 'Punta Batsan, Cawayan, Masbate',
            'unit' => 'CS',
            'contact_number' => '8456132652',
            'office' => 'Comfort Room',
            'monthly_net_pay' => '60000',
            'amount_requested' => '200000',

            'co_lastname' => 'Labini',
            'co_firstname' => 'Aaron',
            'co_middle_initial' => 'B',
            'co_date_of_birth' => '2021-11-27',
            'co_age' => '21',
            'co_tin' => '4561324',
            'co_address' => 'Punta Batsan, Cawayan, Masbate',
            'co_unit' => 'CS',
            'co_contact_number' => '8456132652',
            'co_office' => 'Comfort Room',
            'co_monthly_net_pay' => '60000',
            'co_amount_requested' => '200000',

        ];

        $pdf = PDF::loadView('member-views.generate-mpl-app-form', $data)->setPaper('legal', 'portrait');

        return $pdf->download('MPL Application Form.pdf');
    }

    public function generateHSL(){
        $data = [
            'currentdate' => date('Y-m-d'),
            'lastname' => 'Labini',
            'firstname' => 'Aaron',
            'middle_initial' => 'B',
            'date_of_birth' => '2021-11-27',
            'age' => '21',
            'tin' => '4561324',
            'address' => 'Punta Batsan, Cawayan, Masbate',
            'unit' => 'CS',
            'contact_number' => '8456132652',
            'office' => 'Comfort Room',
            'monthly_net_pay' => '60000',
            'amount_requested' => '200000',
            'payment_period' => '12',

            'co_lastname' => 'Labini',
            'co_firstname' => 'Aaron',
            'co_middle_initial' => 'B',
            'co_date_of_birth' => '2021-11-27',
            'co_age' => '21',
            'co_tin' => '4561324',
            'co_address' => 'Punta Batsan, Cawayan, Masbate',
            'co_unit' => 'CS',
            'co_contact_number' => '8456132652',
            'co_office' => 'Comfort Room',
            'co_monthly_net_pay' => '60000',
            'co_amount_requested' => '200000',

        ];

        $pdf = PDF::loadView('member-views.hsl-second-page', $data)->setPaper('legal', 'portrait');

        return $pdf->download('HSL Application Form.pdf');
    }

    // Add more methods for generating additional PDFs if needed

}

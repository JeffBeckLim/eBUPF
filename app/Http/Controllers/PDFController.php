<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PDFController extends controller{
    public function generateMembershipForm()
    {
        $data = [
            // Pass any data you need to the PDF view
            'title' => 'PDF 1 Title',
            'content' => 'This is the content of PDF 1.',
        ];
        $pdf = PDF::loadView('member-views.generate-membership-form', $data)->setPaper('letter', 'portrait');
        return $pdf->download('Membership Application Form.pdf');
    }

    public function hslapplication()
    {

    }

    // Add more methods for generating additional PDFs if needed

}

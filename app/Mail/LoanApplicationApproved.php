<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Member;

class LoanApplicationApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    public $loan_type;
    public $loan_code;

    /**
     * Create a new message instance.
     */
    public function __construct(Member $member, $loan_type, $loan_code)
    {
        //
        $this->member = $member;
        $this->loan_type = $loan_type;
        $this->loan_code = $loan_code;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Loan Application Approved',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin-views.admin-loan-applications-tracking.email-notif',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Member;

class PaidLoan extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    public $loan;
    public $date;
    public $loan_type;
    /**
     * Create a new message instance.
     */
    public function __construct(Member $member, $loan_type, $loan, $date )
    {
        //
        $this->loan_type = $loan_type;
        $this->member = $member;
        $this->loan = $loan;
        $this->date = $date;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Paid Loan',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin-views.admin-loan-remittance.email-notif-paid-loan',
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

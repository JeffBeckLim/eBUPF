<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Member;

class SuccessfulPayment extends Mailable
{

    use Queueable, SerializesModels;
    public $member;
    public $principal_amount;
    public $interest;
    public $loan;
    public $date;
    public $OR_number;
    /**
     * Create a new message instance.
     */
    public function __construct(Member $member, $principal_amount, $interest, $loan, $date, $OR_number)
    {
        $this->member = $member;
        $this->principal_amount = $principal_amount;
        $this->interest = $interest;
        $this->loan = $loan;
        $this->OR_number = $OR_number;
        $this->date = $date;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Successful Loan Payment',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin-views.admin-loan-remittance.email-notif',
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

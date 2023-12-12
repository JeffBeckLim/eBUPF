<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AddPenalty extends Mailable
{
    public $member;
    public $totalPenalty;
    public $penaltyMonth;
    public $penalizedYear;
    public $loan_type;
    public $loan;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($member, $totalPenalty, $penaltyMonth, $penalizedYear, $loanType, $loan)
    {
        $this->member = $member;
        $this->totalPenalty = $totalPenalty;
        $this->penaltyMonth = $penaltyMonth;
        $this->penalizedYear = $penalizedYear;
        $this->loan_type = $loanType;
        $this->loan = $loan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Loan Penalty',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin-views.admin-ledgers.email-notif-add-penalty',
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

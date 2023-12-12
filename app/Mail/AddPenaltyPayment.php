<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AddPenaltyPayment extends Mailable
{
    public $member;
    public $totalPenaltyPayment;
    public $penaltyMonth;
    public $penalizedYear;
    public $loan_type;
    public $loan;
    public $orNumber;
    public $paymentDate;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($member, $totalPenaltyPayment, $penaltyMonth, $penalizedYear, $loanType, $loan, $orNumber, $paymentDate)
    {

        // FOrmat the payment date
        $paymentDate = date('F d, Y', strtotime($paymentDate));

        $this->member = $member;
        $this->totalPenaltyPayment = $totalPenaltyPayment;
        $this->penaltyMonth = $penaltyMonth;
        $this->penalizedYear = $penalizedYear;
        $this->loan_type = $loanType;
        $this->loan = $loan;
        $this->orNumber = $orNumber;
        $this->paymentDate = $paymentDate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Successful Loan Penalty Payment',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin-views.admin-ledgers.email-notif-add-penalty-payment',
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

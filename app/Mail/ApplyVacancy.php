<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplyVacancy extends Mailable
{
    use Queueable, SerializesModels;

    protected $companyFullName;
    protected $applicant;
    protected $proposal;

    /**
     * Create a new message instance.
     */
    public function __construct($companyFullName, $applicant, $proposal)
    {
        $this->companyFullName = $companyFullName;
        $this->applicant = $applicant;
        $this->proposal = $proposal;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pemberitahuan Pelamar Baru Untuk Lowongan Magang',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.apply-vacancy',
            with: [
                'companyFullName' => $this->companyFullName,
                'applicantName' => ($this->applicant->student->profile->first_name ?? 'Username') . ' ' . $this->applicant->student->profile->last_name ?? '',
                'applicantEmail' => $this->applicant->email,
                'proposalTitle' => $this->proposal->title,
            ]
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

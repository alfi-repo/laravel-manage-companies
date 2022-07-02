<?php

namespace App\Mail;

use Carbon\CarbonInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCompanyNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param  string  $receiver
     * @param  string  $name
     * @param  string|null  $email
     * @param  string|null  $logoUrl
     * @param  string|null  $website
     * @param  CarbonInterface|null  $time
     */
    public function __construct(
        public string           $receiver,
        public string           $name,
        public ?string          $email,
        public ?string          $logoUrl,
        public ?string          $website,
        public ?CarbonInterface $time
    ) {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.company.new-company-notification')
                    ->to($this->receiver)
                    ->subject('New Company Created');
    }
}

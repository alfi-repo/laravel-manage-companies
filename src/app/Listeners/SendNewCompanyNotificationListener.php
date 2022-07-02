<?php

namespace App\Listeners;

use App\Events\CompanyCreated;
use App\Mail\NewCompanyNotificationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewCompanyNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Handle the event.
     *
     * @param  \App\Events\CompanyCreated  $event
     * @return void
     */
    public function handle(CompanyCreated $event)
    {
        $email = auth()->user()->email ?? config('mail.backup_address');
        Mail::queue(new NewCompanyNotificationMail(
            $email,
            $event->company->name,
            $event->company->email,
            $event->company->logo_url,
            $event->company->website,
            $event->company->created_at,
        ));
    }
}

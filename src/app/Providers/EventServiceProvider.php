<?php

namespace App\Providers;

use App\Events\CompanyCreated;
use App\Events\EmployeeCreated;
use App\Listeners\SendNewCompanyNotificationListener;
use App\Models\Company;
use App\Observers\CompanyObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class      => [
            SendEmailVerificationNotification::class,
        ],
        CompanyCreated::class  => [
            SendNewCompanyNotificationListener::class,
        ],
        EmployeeCreated::class => [
            //
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }

    protected $observers = [
        Company::class => CompanyObserver::class,
    ];
}

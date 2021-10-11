<?php

namespace App\Providers;

use App\Actions\AcknowledgeRegistrationAction;
use App\Actions\TopupRegistrantAction;
use App\Events\ContactCreated;
use App\Events\ContactRegistered;
use App\Notifications\AcknowledgeRegistration;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ContactCreated::class => [
            AcknowledgeRegistrationAction::class
        ],
        ContactRegistered::class => [
            TopupRegistrantAction::class
        ]
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
}

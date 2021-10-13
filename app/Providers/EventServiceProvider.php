<?php

namespace App\Providers;

use App\Events\ContactCreated;
use App\Events\ContactCheckedin;
use App\Events\ContactRegistered;
use App\Actions\TopupCheckinAction;
use App\Actions\DDay\DeputizeContact;
use App\Notifications\SendContactPIN;
use Illuminate\Support\Facades\Event;
use App\Actions\TopupRegistrantAction;
use Illuminate\Auth\Events\Registered;
use App\Actions\AcknowledgeRegistrationAction;
use App\Notifications\AcknowledgeRegistration;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
//        ContactCreated::class => [
//            AcknowledgeRegistrationAction::class
//        ],
        ContactRegistered::class => [
            TopupRegistrantAction::class
        ],
        ContactCheckedin::class => [
            DeputizeContact::class,
            TopupCheckinAction::class
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
}

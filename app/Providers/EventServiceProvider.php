<?php

namespace App\Providers;

use App\Domains\Common\Events\ContactCreated;
use App\Domains\DDay\Events\ContactCheckedin;
use App\Domains\Campaign\Events\ContactRegistered;
use App\Domains\DDay\Actions\TopupCheckinAction;
use App\Domains\DDay\Actions\DeputizeContact;
use App\Domains\DDay\Notifications\SendContactPIN;
use Illuminate\Support\Facades\Event;
use App\Domains\Campaign\Actions\TopupRegistrantAction;
use Illuminate\Auth\Events\Registered;
use App\Domains\Campaign\Actions\AcknowledgeRegistrationAction;
use App\Domains\Campaign\Notifications\AcknowledgeRegistration;
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
        ContactCreated::class => [
            AcknowledgeRegistrationAction::class
        ],
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

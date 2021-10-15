<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Domains\Common\Events\ContactCreated;
use App\Domains\DDay\Events\{ContactCheckedIn,
    ContactCounted,
    ContactEgressed,
    ContactIngressed,
    ContactTransmitted,
    ContactVolunteered,
    ContactVoted};
use App\Domains\DDay\{Listeners\SendCheckinLink,
    Listeners\SendCountInstructions,
    Listeners\SendCountLink,
    Listeners\SendCountTopup,
    Listeners\SendEgressInstructions,
    Listeners\SendEgressLink,
    Listeners\SendEgressTopup,
    Listeners\SendIngressLink,
    Listeners\SendIngressTopup,
    Listeners\SendTransmissionInstructions,
    Listeners\SendTransmissionLink,
    Listeners\SendTransmissionTopup,
    Listeners\SendVoteInstructions,
    Listeners\SendVoteLink,
    Listeners\SendVoteTopup};
use App\Domains\DDay\Listeners\SendCheckinTopup;
use App\Domains\Campaign\Events\ContactRegistered;
use App\Domains\Campaign\Listeners\{SendCampaignTopup};
use App\Domains\Campaign\Listeners\SendCampaignWelcome;
use App\Domains\DDay\Listeners\SendCheckinInstructions;
use App\Domains\DDay\Listeners\SendIngressInstructions;
use App\Domains\DDay\Listeners\SendCheckinAuthorization;
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
//        Registered::class => [
//            SendEmailVerificationNotification::class,
//        ],
//        ContactCreated::class => [
//            SendCampaignWelcome::class
//        ],
//        ContactRegistered::class => [
//            SendCampaignTopup::class
//        ],
        ContactVolunteered::class => [
            SendCheckinLink::class,
            SendCheckinInstructions::class,
        ],
        ContactCheckedIn::class => [
            SendCheckinTopup::class,
            SendCheckinAuthorization::class,
            SendIngressInstructions::class,
            SendIngressLink::class,
        ],
        ContactIngressed::class => [
            SendIngressTopup::class,
            SendVoteInstructions::class,
            SendVoteLink::class,
        ],
        ContactVoted::class => [
            SendVoteTopup::class,
            SendCountInstructions::class,
            SendCountLink::class,
        ],
        ContactCounted::class => [
            SendCountTopup::class,
            SendTransmissionInstructions::class,
            SendTransmissionLink::class,
        ],
        ContactTransmitted::class => [
            SendTransmissionTopup::class,
            SendEgressInstructions::class,
            SendEgressLink::class,
        ],
        ContactEgressed::class => [
            SendEgressTopup::class,
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

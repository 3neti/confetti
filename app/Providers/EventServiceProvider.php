<?php

namespace App\Providers;

use App\Domains\Demo\Events\ContactDemoRegistered;
use App\Domains\Campaign\Events\ContactConsidered;
use App\Domains\Campaign\Events\ContactConverted;
use App\Domains\Campaign\Events\ContactDecided;
use App\Domains\Campaign\Events\ContactEvaluated;
use App\Domains\Campaign\Events\ContactInterested;
use App\Domains\Campaign\Events\ContactMadeAware;
use App\Domains\Common\Listeners\ClosingRemarks;
use App\Domains\Demo\Listeners\SendDemoRegisterTopup;
use App\Domains\General\Events\ContactReported;
use App\Domains\General\Listeners\SendIncidentReport;
use Illuminate\Auth\Events\Registered;
use App\Domains\Common\Events\ContactCreated;
use App\Domains\DDay\Events\{ContactCheckedIn,
    ContactCounted,
    ContactEgressed,
    ContactIngressed,
    ContactTransmitted,
    ContactVolunteered,
    ContactVoted};
use App\Domains\DDay\{Listeners\SendCheckinDDayTopup,
    Listeners\SendCheckinDDayLink,
    Listeners\SendCountInstructions,
    Listeners\SendCountDDayLink,
    Listeners\SendCountDDayTopup,
    Listeners\SendEgressInstructions,
    Listeners\SendEgressDDayLink,
    Listeners\SendEgressDDayTopup,
    Listeners\SendIncidentDDayLink,
    Listeners\SendIngressDDayLink,
    Listeners\SendIngressDDayTopup,
    Listeners\SendTransmissionInstructions,
    Listeners\SendTransmissionDDayLink,
    Listeners\SendTransmissionDDayTopup,
    Listeners\SendVoteInstructions,
    Listeners\SendVoteDDayLink,
    Listeners\SendVoteDDayTopup};
use App\Domains\Campaign\Listeners\{SendAwarenessTopup,
    SendAwarenessLink,
    SendConsideredLink,
    SendConsideredTopup,
    SendConvertedLink,
    SendConvertedTopup,
    SendDecidedLink,
    SendDecidedTopup,
    SendEvaluatedLink,
    SendEvaluatedTopup,
    SendInterestedLink,
    SendInterestedTopup};
use App\Domains\Campaign\Deprecate\SendCampaignWelcome;
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
        ContactDemoRegistered::class => [
            SendDemoRegisterTopup::class,
            ClosingRemarks::class,
        ],
        ContactVolunteered::class => [
            SendCheckinInstructions::class,
            SendCheckinDDayLink::class,
            SendIncidentDDayLink::class,
        ],
        ContactCheckedIn::class => [
            SendCheckinDDayTopup::class,
            SendCheckinAuthorization::class,
            SendIngressInstructions::class,
            SendIngressDDayLink::class,
        ],
        ContactIngressed::class => [
            SendIngressDDayTopup::class,
            SendVoteInstructions::class,
            SendVoteDDayLink::class,
        ],
        ContactVoted::class => [
            SendVoteDDayTopup::class,
            SendCountInstructions::class,
            SendCountDDayLink::class,
        ],
        ContactCounted::class => [
            SendCountDDayTopup::class,
            SendTransmissionInstructions::class,
            SendTransmissionDDayLink::class,
        ],
        ContactTransmitted::class => [
            SendTransmissionDDayTopup::class,
            SendEgressInstructions::class,
            SendEgressDDayLink::class,
        ],
        ContactEgressed::class => [
            SendEgressDDayTopup::class,
            ClosingRemarks::class,
        ],
        ContactMadeAware::class => [
            SendAwarenessTopup::class,
            SendAwarenessLink::class,
        ],
        ContactInterested::class => [
            SendInterestedTopup::class,
            SendInterestedLink::class,
        ],
        ContactConsidered::class => [
            SendConsideredTopup::class,
            SendConsideredLink::class,
        ],
        ContactEvaluated::class => [
            SendEvaluatedTopup::class,
            SendEvaluatedLink::class,
        ],
        ContactDecided::class => [
            SendDecidedTopup::class,
            SendDecidedLink::class,
        ],
        ContactConverted::class => [
            SendConvertedTopup::class,
            SendConvertedLink::class,
        ],
        ContactReported::class => [
            SendIncidentReport::class
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

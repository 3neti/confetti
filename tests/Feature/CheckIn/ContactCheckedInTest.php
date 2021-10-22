<?php

namespace Tests\Feature\CheckIn;

use Tests\TestCase;
use App\Domains\DDay\Listeners\{
    SendCheckinDDayTopup,
    SendCheckinAuthorization,
    SendIngressInstructions,
    SendIngressDDayLink
};
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use App\Domains\DDay\Events\ContactCheckedIn;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ContactCheckedInTest extends TestCase
{
    /** @test */
    public function contact_checked_in_event_has_send_checkin_dday_topup_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactCheckedIn::class,
            SendCheckinDDayTopup::class
        );
    }

    /** @test */
    public function contact_checked_in_event_has_send_checkin_authorization_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactCheckedIn::class,
            SendCheckinAuthorization::class
        );
    }

    /** @test */
    public function contact_checked_in_event_has_send_ingress_instructions_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactCheckedIn::class,
            SendIngressInstructions::class
        );
    }

    /** @test */
    public function contact_checked_in_event_has_send_ingress_dday_link_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactCheckedIn::class,
            SendIngressDDayLink::class
        );
    }
}

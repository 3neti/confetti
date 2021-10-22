<?php

namespace Tests\Feature\Transmission;

use Tests\TestCase;
use App\Domains\DDay\Listeners\{
    SendTransmissionDDayTopup,
    SendEgressInstructions,
    SendEgressDDayLink};
use Illuminate\Support\Facades\Event;
use App\Domains\DDay\Events\ContactTransmitted;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ContactTransmittedTest extends TestCase
{
    /** @test */
    public function contact_transmitted_event_has_send_transmission_dday_topup_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactTransmitted::class,
            SendTransmissionDDayTopup::class
        );
    }

    /** @test */
    public function contact_transmitted_event_has_send_egress_instructions_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactTransmitted::class,
            SendEgressInstructions::class
        );
    }

    /** @test */
    public function contact_transmitted_event_has_send_egress_dday_link_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactTransmitted::class,
            SendEgressDDayLink::class
        );
    }
}

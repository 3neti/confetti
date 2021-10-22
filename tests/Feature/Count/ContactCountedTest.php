<?php

namespace Tests\Feature\Count;

use Tests\TestCase;
use App\Domains\DDay\Listeners\{
    SendCountDDayTopup,
    SendTransmissionInstructions,
    SendTransmissionDDayLink};
use Illuminate\Support\Facades\Event;
use App\Domains\DDay\Events\ContactCounted;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ContactCountedTest extends TestCase
{
    /** @test */
    public function contact_counted_event_has_send_vote_dday_topup_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactCounted::class,
            SendCountDDayTopup::class
        );
    }

    /** @test */
    public function contact_counted_event_has_send_count_instructions_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactCounted::class,
            SendTransmissionInstructions::class
        );
    }

    /** @test */
    public function contact_counted_event_has_send_count_dday_link_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactCounted::class,
            SendTransmissionDDayLink::class
        );
    }
}

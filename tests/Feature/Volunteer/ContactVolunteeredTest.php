<?php

namespace Tests\Feature\Volunteer;

use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use App\Domains\DDay\Events\ContactVolunteered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Listeners\{SendCheckinInstructions, SendCheckinDDayLink};

class ContactVolunteeredTest extends TestCase
{
    /** @test */
    public function contact_volunteered_event_has_send_checkin_instructions_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactVolunteered::class,
            SendCheckinInstructions::class
        );
    }

    /** @test */
    public function contact_volunteered_event_has_send_checkin_dday_link_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactVolunteered::class,
            SendCheckinDDayLink::class
        );
    }


}

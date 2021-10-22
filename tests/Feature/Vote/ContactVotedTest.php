<?php

namespace Tests\Feature\Vote;

use Tests\TestCase;
use App\Domains\DDay\Listeners\{
    SendVoteDDayTopup,
    SendCountInstructions,
    SendCountDDayLink};
use Illuminate\Support\Facades\Event;
use App\Domains\DDay\Events\ContactVoted;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ContactVotedTest extends TestCase
{
    /** @test */
    public function contact_voted_event_has_send_vote_dday_topup_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactVoted::class,
            SendVoteDDayTopup::class
        );
    }

    /** @test */
    public function contact_voted_event_has_send_count_instructions_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactVoted::class,
            SendCountInstructions::class
        );
    }

    /** @test */
    public function contact_voted_event_has_send_count_dday_link_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactVoted::class,
            SendCountDDayLink::class
        );
    }
}

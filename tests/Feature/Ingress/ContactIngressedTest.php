<?php

namespace Tests\Feature\Ingress;

use Tests\TestCase;
use App\Domains\DDay\Listeners\{
    SendIngressDDayTopup,
    SendVoteInstructions,
    SendVoteDDayLink};
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use App\Domains\DDay\Events\ContactIngressed;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ContactIngressedTest extends TestCase
{
    /** @test */
    public function contact_ingressed_event_has_send_ingressed_dday_topup_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactIngressed::class,
            SendIngressDDayTopup::class
        );
    }

    /** @test */
    public function contact_ingressed_event_has_send_vote_instructions_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactIngressed::class,
            SendVoteInstructions::class
        );
    }

    /** @test */
    public function contact_ingressed_event_has_send_vote_dday_link_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactIngressed::class,
            SendVoteDDayLink::class
        );
    }
}

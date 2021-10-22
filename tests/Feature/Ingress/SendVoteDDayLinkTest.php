<?php

namespace Tests\Feature\Ingress;

use Tests\TestCase;
use App\Models\Contact;
use App\Domains\Common\Notifications\Link;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Domains\DDay\Listeners\SendVoteDDayLink;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendVoteDDayLinkTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_vote_dday_link_works()
    {
        Notification::fake();

        /*** arrange ***/
        $message =
            "To report your vote, " .
            "please click the following VOTE link: bit.ly/DDayVote";
        $listener = app(SendVoteDDayLink::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Link::class, function ($notification) use ($contact, $message) {
            return $notification->getContent($contact) == $message;
        });
    }
}

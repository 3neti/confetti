<?php

namespace Tests\Feature\Transmission;

use Tests\TestCase;
use App\Models\Contact;
use App\Domains\Common\Notifications\Link;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Listeners\SendEgressDDayLink;

class SendEgressDDayLinkTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_egress_dday_link_works()
    {
        Notification::fake();

        /*** arrange ***/
        $message =
            "To report the candidate's position results, " .
            "please click the following EGRESS link: bit.ly/DDayEgress";
        $listener = app(SendEgressDDayLink::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Link::class, function ($notification) use ($contact, $message) {
            return $notification->getContent($contact) == $message;
        });
    }
}

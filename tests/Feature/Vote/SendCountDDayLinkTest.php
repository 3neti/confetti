<?php

namespace Tests\Feature\Vote;

use Tests\TestCase;
use App\Models\Contact;
use App\Domains\Common\Notifications\Link;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Domains\DDay\Listeners\SendCountDDayLink;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendCountDDayLinkTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_count_dday_link_works()
    {
        Notification::fake();

        /*** arrange ***/
        $message =
            "To report your tally, " .
            "please click the following COUNT link: bit.ly/DDayCount";
        $listener = app(SendCountDDayLink::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Link::class, function ($notification) use ($contact, $message) {
            return $notification->getContent($contact) == $message;
        });
    }
}

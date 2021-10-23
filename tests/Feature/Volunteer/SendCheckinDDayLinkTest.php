<?php

namespace Tests\Feature\Volunteer;

use Tests\TestCase;
use App\Models\Contact;
use App\Domains\Common\Notifications\Link;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Domains\DDay\Listeners\SendCheckinDDayLink;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendCheckinDDayLinkTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_checkin_dday_link_works()
    {
        Notification::fake();

        /*** arrange ***/
        $message =
            "To signify intention in executing your poll watching duties, " .
            "please click the following CHECKIN link: bit.ly/DDayCheckIn";
        $listener = app(SendCheckinDDayLink::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Link::class, function ($notification) use ($contact, $message) {
            return $notification->getContent($contact) == $message;
        });
    }
}

<?php

namespace Tests\Feature\Count;

use Tests\TestCase;
use App\Models\Contact;
use App\Domains\Common\Notifications\Link;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Listeners\SendTransmissionDDayLink;

class SendTransmissionDDayLinkTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_transmission_dday_link_works()
    {
        Notification::fake();

        /*** arrange ***/
        $message =
            "To report the transmission proceedings, " .
            "please click the following TRANSMISSION link: bit.ly/DDayTransmission";
        $listener = app(SendTransmissionDDayLink::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Link::class, function ($notification) use ($contact, $message) {
            return $notification->getContent($contact) == $message;
        });
    }
}

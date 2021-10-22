<?php

namespace Tests\Feature\CheckIn;

use Tests\TestCase;
use App\Models\Contact;
use App\Domains\Common\Notifications\Link;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Domains\DDay\Listeners\SendIngressDDayLink;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendIngressDDayLinkTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_ingress_dday_link_works()
    {
        Notification::fake();

        /*** arrange ***/
        $message =
            "To report your presence in the voting center, " .
            "please click the following INGRESS link: bit.ly/DDayIngress";
        $listener = app(SendIngressDDayLink::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Link::class, function ($notification) use ($contact, $message) {
//            dd($notification->getContent($contact));
            return $notification->getContent($contact) == $message;
        });
    }
}

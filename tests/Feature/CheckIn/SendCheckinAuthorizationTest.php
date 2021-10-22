<?php

namespace Tests\Feature\CheckIn;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Domains\DDay\Notifications\Authorization;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Listeners\SendCheckinAuthorization;

class SendCheckinAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_checkin_dday_authorization_works()
    {
        Notification::fake();

        /*** arrange ***/
        $pin = 4321;
        $message = "This is your authorization code: 4321. You will use it to authenticate your reports. - HQ";
        $listener = app(SendCheckinAuthorization::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Authorization::class, function ($notification) use ($contact, $message, $pin) {
            $notification->setPIN($pin);

            return $notification->getContent($contact) == $message;
        });
    }
}

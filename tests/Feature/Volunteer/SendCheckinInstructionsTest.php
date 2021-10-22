<?php

namespace Tests\Feature\Volunteer;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Domains\Common\Notifications\Instructions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Listeners\SendCheckinInstructions;

class SendCheckinInstructionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_dday_checkin_instructions_works()
    {
        Notification::fake();

        /*** arrange ***/
        $message =
            "Thank you for becoming a volunteer. This system of text messages will be your poll watching guide. " .
            "You will receive a separate SMS for the URL link. You will need an internet connection. " .
            "Enter the data required by the system and follow the instructions. " .
            "You should know the way to your assigned precinct. Be there by 6:00 AM. ".
            "Bring your official ID, mobile phone, pen and paper. " .
            "You will given enough cellphone load and GCash in order for you to perform your duties.";
        $listener = app(SendCheckinInstructions::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Instructions::class, function ($notification) use ($contact, $message) {
            return $notification->getContent($contact) == $message;
        });
    }
}

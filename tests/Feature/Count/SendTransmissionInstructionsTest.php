<?php

namespace Tests\Feature\Count;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Domains\Common\Notifications\Instructions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Listeners\SendTransmissionInstructions;

class SendTransmissionInstructionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_dday_transmission_instructions_works()
    {
        Notification::fake();

        /*** arrange ***/
        $message =
            "1. Take a picture of the printed election return if you can. 2. Don't go out. " .
            "3. Find out if the transmission was successful. 4. Or if the SD Card has been retrieved".
            "5. Stay vigilant!" .
            "You will receive a separate SMS for the URL link of the next stage. " .
            "6. Click the link when you just left the voting center.";
        $listener = app(SendTransmissionInstructions::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Instructions::class, function ($notification) use ($contact, $message) {
            return $notification->getContent($contact) == $message;
        });
    }
}

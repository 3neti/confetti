<?php

namespace Tests\Feature\Vote;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Domains\Common\Notifications\Instructions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Listeners\SendCountInstructions;

class SendCountInstructionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_dday_count_instructions_works()
    {
        Notification::fake();

        /*** arrange ***/
        $message =
            "1. Take a picture of the results in the blackboard if you can. 2. Don't go out. " .
            "3. Find out the winners in each of the positions 4. Stay vigilant!" .
            "You will receive a separate SMS for the URL link of the next stage. " .
            "5. Click the link when BEI has transmitted or failed to transmit.";
        $listener = app(SendCountInstructions::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Instructions::class, function ($notification) use ($contact, $message) {
            return $notification->getContent($contact) == $message;
        });
    }
}

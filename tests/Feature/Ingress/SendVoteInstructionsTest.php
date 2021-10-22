<?php

namespace Tests\Feature\Ingress;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Domains\Common\Notifications\Instructions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Listeners\SendVoteInstructions;

class SendVoteInstructionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_dday_vote_instructions_works()
    {
        Notification::fake();

        /*** arrange ***/
        $message =
            "1. Vote right away! 2. Take a picture of the ballot receipt if you can. 3. Don't go out. " .
            "4. Find out if there are policemen and military men nearby. 5. Stay vigilant!" .
            "You will receive a separate SMS for the URL link of the next stage. " .
            "6. Click the link when BEI has voting has ended and the results are already finalized.";
        $listener = app(SendVoteInstructions::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Instructions::class, function ($notification) use ($contact, $message) {
            return $notification->getContent($contact) == $message;
        });
    }
}

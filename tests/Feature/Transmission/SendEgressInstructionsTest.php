<?php

namespace Tests\Feature\Transmission;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Domains\Common\Notifications\Instructions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Listeners\SendEgressInstructions;

class SendEgressInstructionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_dday_egress_instructions_works()
    {
        Notification::fake();

        /*** arrange ***/
        $message =
            "1. You may safely leave the voting center. 2. Go straight home. " .
            "3. From the electronic election return, you will be reporting the result of the candidate's position".
            "4. Thank you!" .
            "You will receive your payment shortly. " .
            "5. Click the link when you are already safe outside.";
        $listener = app(SendEgressInstructions::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Instructions::class, function ($notification) use ($contact, $message) {
            return $notification->getContent($contact) == $message;
        });
    }
}

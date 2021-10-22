<?php

namespace Tests\Feature\CheckIn;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Domains\Common\Notifications\Instructions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Listeners\SendIngressInstructions;

class SendIngressInstructionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_dday_ingress_instructions_works()
    {
        Notification::fake();

        /*** arrange ***/
        $message =
            "1. You will receive a PIN - memorize it. 2. Proceed to your assigned precinct. " .
            "3. Find out the cluster # of the precinct. 4. Know the name of the BEI Chairperson. " .
            "5. Check the status of the VCM - if it's sealed or not. 6. Register in attendance sheet right away. ".
            "You will receive a separate SMS for the URL link of the next stage. " .
            "8. Click the link when you're inside the voting center.";
        $listener = app(SendIngressInstructions::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Instructions::class, function ($notification) use ($contact, $message) {
            return $notification->getContent($contact) == $message;
        });
    }
}

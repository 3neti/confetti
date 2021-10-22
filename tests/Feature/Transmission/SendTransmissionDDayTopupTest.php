<?php

namespace Tests\Feature\Transmission;

use Tests\TestCase;
use App\Models\Contact;
use App\Domains\Common\Notifications\Topup;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Listeners\SendTransmissionDDayTopup;

class SendTransmissionDDayTopupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_transmission_dday_top_works()
    {
        Notification::fake();

        /*** arrange ***/
        $amount = 1111; //see TRANSMISSION_TOPUP in phpunit.xml
        $listener = app(SendTransmissionDDayTopup::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Topup::class, function ($notification) use ($contact, $amount) {
            return $notification->getAmount($contact) == $amount;
        });
    }
}

<?php

namespace Tests\Feature\Egress;

use Tests\TestCase;
use App\Models\Contact;
use App\Domains\Common\Notifications\Topup;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Listeners\SendEgressDDayTopup;

class SendEgressDDayTopupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_egress_dday_top_works()
    {
        Notification::fake();

        /*** arrange ***/
        $amount = 222; //see EGRESS_TOPUP in phpunit.xml
        $listener = app(SendEgressDDayTopup::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Topup::class, function ($notification) use ($contact, $amount) {
            return $notification->getAmount($contact) == $amount;
        });
    }
}

<?php

namespace Tests\Feature\CheckIn;

use Tests\TestCase;
use App\Models\Contact;
use App\Domains\Common\Notifications\Topup;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Domains\DDay\Listeners\SendCheckinDDayTopup;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendCheckinDDayTopupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_checkin_dday_top_works()
    {
        Notification::fake();

        /*** arrange ***/
        $amount = 537; //see CHECKIN_TOPUP in phpunit.xml
        $listener = app(SendCheckinDDayTopup::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Topup::class, function ($notification) use ($contact, $amount) {
            return $notification->getAmount($contact) == $amount;
        });
    }
}

<?php

namespace Tests\Feature\Count;

use Tests\TestCase;
use App\Models\Contact;
use App\Domains\Common\Notifications\Topup;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Listeners\SendCountDDayTopup;

class SendCountDDayTopupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_count_dday_top_works()
    {
        Notification::fake();

        /*** arrange ***/
        $amount = 888; //see VOTE_TOPUP in phpunit.xml
        $listener = app(SendCountDDayTopup::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Topup::class, function ($notification) use ($contact, $amount) {
            return $notification->getAmount($contact) == $amount;
        });
    }
}

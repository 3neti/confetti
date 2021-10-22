<?php

namespace Tests\Feature\Vote;

use Tests\TestCase;
use App\Models\Contact;
use App\Domains\Common\Notifications\Topup;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Domains\DDay\Listeners\SendVoteDDayTopup;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendVoteDDayTopupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_vote_dday_top_works()
    {
        Notification::fake();

        /*** arrange ***/
        $amount = 1000; //see VOTE_TOPUP in phpunit.xml
        $listener = app(SendVoteDDayTopup::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Topup::class, function ($notification) use ($contact, $amount) {
            return $notification->getAmount($contact) == $amount;
        });
    }
}

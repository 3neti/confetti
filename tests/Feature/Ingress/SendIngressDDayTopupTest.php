<?php

namespace Tests\Feature\Ingress;

use Tests\TestCase;
use App\Models\Contact;
use App\Domains\Common\Notifications\Topup;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Domains\DDay\Listeners\SendIngressDDayTopup;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendIngressDDayTopupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_ingress_dday_top_works()
    {
        Notification::fake();

        /*** arrange ***/
        $amount = 722; //see INGRESS_TOPUP in phpunit.xml
        $listener = app(SendIngressDDayTopup::class);
        $contact = Contact::factory()->create();

        /*** act ***/
        $listener->handle($contact);

        /*** assert ***/
        Notification::assertSentTo($contact, Topup::class, function ($notification) use ($contact, $amount) {
            return $notification->getAmount($contact) == $amount;
        });
    }
}

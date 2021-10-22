<?php

namespace Tests\Feature\Egress;

use Tests\TestCase;

use Illuminate\Support\Facades\Event;
use App\Domains\DDay\Events\ContactEgressed;
use Illuminate\Foundation\Testing\WithFaker;
use App\Domains\Common\Listeners\ClosingRemarks;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Listeners\SendEgressDDayTopup;

class ContactEgressedTest extends TestCase
{
    /** @test */
    public function contact_egressed_event_has_send_egress_dday_topup_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactEgressed::class,
            SendEgressDDayTopup::class
        );
    }

    /** @test */
    public function contact_egressed_event_has_send_closing_remarks_attached_as_listener()
    {
        Event::fake();

        Event::assertListening(
            ContactEgressed::class,
            ClosingRemarks::class
        );
    }
}

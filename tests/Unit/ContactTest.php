<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use App\Domains\Common\Events\ContactCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function new_contact_sends_event()
    {
        Event::fake();

        /*** arrange ***/
        /*** act ***/
        $contact = Contact::factory()->create();

        /*** assert ***/
        Event::assertDispatched(ContactCreated::class, function ($event) use ($contact) {
            return $event->contact->mobile == $contact->mobile;
        });
    }
}

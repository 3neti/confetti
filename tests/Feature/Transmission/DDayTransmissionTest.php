<?php

namespace Tests\Feature\Transmission;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use App\Domains\DDay\Events\ContactTransmitted;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Actions\ContactTransmissionAction;

class DDayTransmissionTest extends TestCase
{
    use RefreshDatabase;

    /** @var Contact */
    protected $contact;

    /** @var array */
    protected $data;


    public function setUp(): void
    {
        parent::setUp();

        $this->contact = Contact::factory()->create(['mobile' => '+639173011987']);
        $this->data = [
            "q9_mobile" => "09173011987",
            "q2_pin" => "1234",
            "q3_printed" => "Yes",
            "q4_transmitted" => "Yes",
            "q7_retrieved" => "Yes",
        ];

    }

    /** @test */
    public function transmission_end_point_works()
    {
        /*** arrange ***/
        /*** act ***/
        $response = $this->postJson('/api/dday/transmission', $this->data);

        /*** assert ***/
        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                'post' => [
                    'type' => "Transmission",
                    'features' => [
                        'printed' => true,
                        'transmitted' => true,
                        'retrieved' => true,
                    ],
                    'contact' => [
                        'mobile' => '+639173011987'
                    ],
                ]
            ]
        ]);
    }

    /** @test */
    public function transmission_end_point_requires_mobile_and_pin()
    {
        /*** arrange ***/
        $data = [
            "q2_pin" => "1234",
            "q3_printed" => "Yes",
            "q4_transmitted" => "Yes",
            "q7_retrieved" => "Yes",
        ];

        /*** act ***/
        $response = $this->postJson('/api/dday/transmission', $data);

        /*** assert ***/
        $response->assertUnprocessable();

        /*** arrange ***/
        $data = [
            "q9_mobile" => "09173011987",
            "q3_printed" => "Yes",
            "q4_transmitted" => "Yes",
            "q7_retrieved" => "Yes",
        ];

        /*** act ***/
        $response = $this->postJson('/api/dday/transmission', $data);

        /*** assert ***/
        $response->assertUnprocessable();
    }

    /** @test */
    public function transmission_invokes_contact_transmission_action()
    {
        /*** arrange ***/
        /*** assert ***/
        ContactTransmissionAction::shouldRun();

        /*** act ***/
        $this->postJson('/api/dday/transmission', $this->data);
    }

    /** @test */
    public function transmission_dispatches_contact_transmitted_event()
    {
        Event::fake();

        /*** arrange ***/
        /*** act ***/
        $this->postJson('/api/dday/transmission', $this->data);

        /*** assert ***/
        Event::assertDispatched(ContactTransmitted::class, function ($event) {
            return $event->contact->mobile == '+639173011987';
        });
    }
}

<?php

namespace Tests\Feature\Count;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Support\Facades\Event;
use App\Domains\DDay\Events\ContactCounted;
use Illuminate\Foundation\Testing\WithFaker;
use App\Domains\DDay\Actions\ContactCountAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DDayCountTest extends TestCase
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
            "q3_president" => "Ping Lacson",
            "q4_vicepresident" => "Tito Sotto",
            "q7_governor" => "Cora Malanyaon",
            "q8_congressman" => "Arjo Atayde",
            "q9_mayor" => "Joy Belmonte",
        ];

    }

    /** @test */
    public function count_end_point_works()
    {
        /*** arrange ***/
        /*** act ***/
        $response = $this->postJson('/api/dday/count', $this->data);

        /*** assert ***/
        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                'post' => [
                    'type' => "Count",
                    'features' => [
                        'president' => 'Ping Lacson',
                        'vicepresident' => 'Tito Sotto',
                        'governor' => 'Cora Malanyaon',
                        'congressman' => 'Arjo Atayde',
                        'mayor' => 'Joy Belmonte',
                    ],
                    'contact' => [
                        'mobile' => '+639173011987'
                    ],
                ]
            ]
        ]);
    }

    /** @test */
    public function count_end_point_requires_mobile_and_pin()
    {
        /*** arrange ***/
        $data = [
            "q2_pin" => "1234",
            "q3_president" => "Ping Lacson",
            "q4_vicepresident" => "Tito Sotto",
            "q7_governor" => "Cora Malanyaon",
            "q8_congressman" => "Arjo Atayde",
            "q9_mayor" => "Joy Belmonte",
        ];

        /*** act ***/
        $response = $this->postJson('/api/dday/count', $data);

        /*** assert ***/
        $response->assertUnprocessable();

        /*** arrange ***/
        $data = [
            "q9_mobile" => "09173011987",
            "q3_president" => "Ping Lacson",
            "q4_vicepresident" => "Tito Sotto",
            "q7_governor" => "Cora Malanyaon",
            "q8_congressman" => "Arjo Atayde",
            "q9_mayor" => "Joy Belmonte",
        ];

        /*** act ***/
        $response = $this->postJson('/api/dday/count', $data);

        /*** assert ***/
        $response->assertUnprocessable();
    }

    /** @test */
    public function count_invokes_contact_count_action()
    {
        /*** arrange ***/
        /*** assert ***/
        ContactCountAction::shouldRun();

        /*** act ***/
        $this->postJson('/api/dday/count', $this->data);
    }

    /** @test */
    public function count_dispatches_contact_counted_event()
    {
        Event::fake();

        /*** arrange ***/
        /*** act ***/
        $this->postJson('/api/dday/count', $this->data);

        /*** assert ***/
        Event::assertDispatched(ContactCounted::class, function ($event) {
            return $event->contact->mobile == '+639173011987';
        });
    }
}

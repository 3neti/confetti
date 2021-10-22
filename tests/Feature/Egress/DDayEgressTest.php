<?php

namespace Tests\Feature\Egress;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use App\Domains\DDay\Events\ContactEgressed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Actions\ContactEgressAction;

class DDayEgressTest extends TestCase
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
            "q3_candidate1" => "100",
            "q4_candidate2" => "200",
            "q7_candidate3" => "300",
            "q8_candidate4" => "400",
            "q9_candidate5" => "500",
        ];

    }

    /** @test */
    public function egress_end_point_works()
    {
        /*** arrange ***/
        /*** act ***/
        $response = $this->postJson('/api/dday/egress', $this->data);

        /*** assert ***/
        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                'post' => [
                    'type' => "Egress",
                    'features' => [
                        'candidate1' => 100,
                        'candidate2' => 200,
                        'candidate3' => 300,
                        'candidate4' => 400,
                        'candidate5' => 500,
                    ],
                    'contact' => [
                        'mobile' => '+639173011987'
                    ],
                ]
            ]
        ]);
    }

    /** @test */
    public function egress_end_point_requires_mobile_and_pin()
    {
        /*** arrange ***/
        $data = [
            "q2_pin" => "1234",
            "q3_candidate1" => "100",
            "q4_candidate2" => "200",
            "q7_candidate3" => "300",
            "q8_candidate4" => "400",
            "q9_candidate5" => "500",
        ];

        /*** act ***/
        $response = $this->postJson('/api/dday/egress', $data);

        /*** assert ***/
        $response->assertUnprocessable();

        /*** arrange ***/
        $data = [
            "q9_mobile" => "09173011987",
            "q3_candidate1" => "100",
            "q4_candidate2" => "200",
            "q7_candidate3" => "300",
            "q8_candidate4" => "400",
            "q9_candidate5" => "500",
        ];

        /*** act ***/
        $response = $this->postJson('/api/dday/egress', $data);

        /*** assert ***/
        $response->assertUnprocessable();
    }

    /** @test */
    public function egress_invokes_contact_egress_action()
    {
        /*** arrange ***/
        /*** assert ***/
        ContactEgressAction::shouldRun();

        /*** act ***/
        $this->postJson('/api/dday/egress', $this->data);
    }

    /** @test */
    public function egress_dispatches_contact_egressed_event()
    {
        Event::fake();

        /*** arrange ***/
        /*** act ***/
        $this->postJson('/api/dday/egress', $this->data);

        /*** assert ***/
        Event::assertDispatched(ContactEgressed::class, function ($event) {
            return $event->contact->mobile == '+639173011987';
        });
    }
}

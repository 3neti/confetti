<?php

namespace Tests\Feature\Ingress;

use App\Models\Contact;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use App\Domains\DDay\Events\ContactIngressed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Actions\ContactIngressAction;

class DDayIngressTest extends TestCase
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
            "q3_cluster" => "123456",
            "q4_bei" => "Mr. de la Cruz",
            "q7_sealed" => "Yes",
        ];

    }

    /** @test */
    public function ingress_end_point_works()
    {
        /*** arrange ***/
        /*** act ***/
        $response = $this->postJson('/api/dday/ingress', $this->data);

        /*** assert ***/
        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                'post' => [
                    'type' => "Ingress",
                    'features' => [
                        'cluster' => "123456",
                        'bei' => "Mr. de la Cruz",
                        'sealed' => true
                    ],
                    'contact' => [
                        'mobile' => '+639173011987'
                    ],
                ]
            ]
        ]);
    }

    /** @test */
    public function ingress_end_point_requires_mobile_and_pin()
    {
        /*** arrange ***/
        $data = [
            'q32_pin' => "1234",
            'q33_cluster' => "123456",
            'q34_bei' => "Mr. de la Cruz",
            'q35_sealed' => "Yes",
        ];

        /*** act ***/
        $response = $this->postJson('/api/dday/ingress', $data);

        /*** assert ***/
        $response->assertUnprocessable();

        /*** arrange ***/
        $data = [
            'q29_mobile' => "09173011987",
            'q33_cluster' => "123456",
            'q34_bei' => "Mr. de la Cruz",
            'q35_sealed' => "Yes",
        ];

        /*** act ***/
        $response = $this->postJson('/api/dday/ingress', $data);

        /*** assert ***/
        $response->assertUnprocessable();
    }

    /** @test */
    public function ingress_invokes_contact_ingress_action()
    {
        /*** arrange ***/
        /*** assert ***/
        ContactIngressAction::shouldRun();

        /*** act ***/
        $this->postJson('/api/dday/ingress', $this->data);
    }

    /** @test */
    public function ingress_dispatches_contact_ingressed_event()
    {
        Event::fake();

        /*** arrange ***/
        /*** act ***/
        $this->postJson('/api/dday/ingress', $this->data);

        /*** assert ***/
        Event::assertDispatched(ContactIngressed::class, function ($event) {
            return $event->contact->mobile == '+639173011987';
        });
    }
}

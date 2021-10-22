<?php

namespace Tests\Feature\Vote;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Support\Facades\Event;
use App\Domains\DDay\Events\ContactVoted;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Actions\ContactVoteAction;

class DDayVoteTest extends TestCase
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
            "q3_duration" => "10",
            "q4_police" => "Yes",
            "q7_military" => "Yes",
        ];

    }

    /** @test */
    public function vote_end_point_works()
    {
        /*** arrange ***/
        /*** act ***/
        $response = $this->postJson('/api/dday/vote', $this->data);

        /*** assert ***/
        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                'post' => [
                    'type' => "Vote",
                    'features' => [
                        'duration' => 10,
                        'police' => true,
                        'military' => true
                    ],
                    'contact' => [
                        'mobile' => '+639173011987'
                    ],
                ]
            ]
        ]);
    }

    /** @test */
    public function vote_end_point_requires_mobile_and_pin()
    {
        /*** arrange ***/
        $data = [
            "q2_pin" => "1234",
            "q3_duration" => "10",
            "q4_police" => "Yes",
            "q7_military" => "Yes",
        ];

        /*** act ***/
        $response = $this->postJson('/api/dday/vote', $data);

        /*** assert ***/
        $response->assertUnprocessable();

        /*** arrange ***/
        $data = [
            "q9_mobile" => "09173011987",
            "q3_duration" => "10",
            "q4_police" => "Yes",
            "q7_military" => "Yes",
        ];

        /*** act ***/
        $response = $this->postJson('/api/dday/vote', $data);

        /*** assert ***/
        $response->assertUnprocessable();
    }

    /** @test */
    public function vote_invokes_contact_vote_action()
    {
        /*** arrange ***/
        /*** assert ***/
        ContactVoteAction::shouldRun();

        /*** act ***/
        $this->postJson('/api/dday/vote', $this->data);
    }

    /** @test */
    public function vote_dispatches_contact_voted_event()
    {
        Event::fake();

        /*** arrange ***/
        /*** act ***/
        $this->postJson('/api/dday/vote', $this->data);

        /*** assert ***/
        Event::assertDispatched(ContactVoted::class, function ($event) {
            return $event->contact->mobile == '+639173011987';
        });
    }
}

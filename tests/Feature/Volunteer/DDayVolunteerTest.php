<?php

namespace Tests\Feature\Volunteer;

use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use App\Domains\DDay\Events\ContactVolunteered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\Common\Actions\CreateContactAction;

class DDayVolunteerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function volunteer_end_point_works()
    {
        /*** arrange ***/
        $data = [
            'from' => '09173011987',
        ];

        /*** act ***/
        $response = $this->postJson('/api/dday/volunteer', $data);

        /*** assert ***/
        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                'contact' => [
                    'mobile' => "+639173011987",
                    'handle' => "+639173011987",
                ]
            ]
        ]);
    }

    /** @test */
    public function volunteer_end_point_requires_from()
    {
        /*** arrange ***/
        $data = [];

        /*** act ***/
        $response = $this->postJson('/api/dday/volunteer', $data);

        /*** assert ***/
        $response->assertUnprocessable();
    }

    /** @test */
    public function volunteer_invokes_create_contact_action()
    {
        /*** arrange ***/
        $data = [
            'from' => '09173011987',
        ];

        /*** assert ***/
        CreateContactAction::shouldRun();

        /*** act ***/
        $this->postJson('/api/dday/volunteer', $data);
    }

    /** @test */
    public function volunteer_dispatches_contact_volunteered_event()
    {
        Event::fake();

        /*** arrange ***/
        $data = [
            'from' => '09173011987',
        ];

        /*** act ***/
        $this->postJson('/api/dday/volunteer', $data);

        /*** assert ***/
        Event::assertDispatched(ContactVolunteered::class, function ($event) {
            return $event->contact->mobile == '+639173011987';
        });
    }
}

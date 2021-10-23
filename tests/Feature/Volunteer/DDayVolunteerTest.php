<?php

namespace Tests\Feature\Volunteer;

use App\Models\Contact;
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
        $this->markTestSkipped('fix non-array request');
        /*** arrange ***/
//        $data = [
//            'from' => '09173011987',
//        ];
        $data = ['+639173011987'];

        /*** act ***/
        $response = $this->postJson('/api/dday/volunteer', $data);

        /*** assert ***/

        $response->assertSuccessful();
        dd(Contact::find(1));
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
        $this->markTestSkipped('fix non-array request');
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
        $this->markTestSkipped('fix non-array request');
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
        $this->markTestSkipped('fix non-array request');
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

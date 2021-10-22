<?php

namespace Tests\Feature\CheckIn;

use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use App\Domains\DDay\Events\ContactCheckedIn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\DDay\Actions\ContactCheckInAction;

class DDayCheckInTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function checkin_end_point_works()
    {
        /*** arrange ***/
        $data = [
            'q29_mobile' => "09173011987",
            'q32_location' => "Longitude: 121.0358405\r\nLatitude: 14.6364449",
        ];

        /*** act ***/
        $response = $this->postJson('/api/dday/checkin', $data);

        /*** assert ***/
        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                'checkin' => [
                    'longitude' => 121.0358405,
                    'latitude' => 14.6364449,
                    'contact' => [
                        'mobile' => '+639173011987'
                    ],
                ]
            ]
        ]);
        $response->assertJsonStructure([
            'data' => [
                'checkin' => [
                    'longitude',
                    'latitude',
                    'contact' => [
                        'mobile',
                        'pin'
                    ]
                ]
            ]
        ]);
    }

    /** @test */
    public function checkin_end_point_requires_mobile_location()
    {
        /*** arrange ***/
        $data = [
            'q32_location' => "Longitude: 121.0358405\r\nLatitude: 14.6364449",
        ];

        /*** act ***/
        $response = $this->postJson('/api/dday/checkin', $data);

        /*** assert ***/
        $response->assertUnprocessable();

        /*** arrange ***/
        $data = [
            'q29_mobile' => "09173011987",
        ];

        /*** act ***/
        $response = $this->postJson('/api/dday/checkin', $data);

        /*** assert ***/
        $response->assertUnprocessable();
    }

    /** @test */
    public function checkin_invokes_contact_check_in_action()
    {
        /*** arrange ***/
        $data = [
            'q29_mobile' => "09173011987",
            'q32_location' => "Longitude: 121.0358405\r\nLatitude: 14.6364449",
        ];

        /*** assert ***/
        ContactCheckInAction::shouldRun();

        /*** act ***/
        $this->postJson('/api/dday/checkin', $data);
    }

    /** @test */
    public function checkin_dispatches_contact_checkin_event()
    {
        Event::fake();

        /*** arrange ***/
        $data = [
            'q29_mobile' => "09173011987",
            'q32_location' => "Longitude: 121.0358405\r\nLatitude: 14.6364449",
        ];

        /*** act ***/
        $this->postJson('/api/dday/checkin', $data);

        /*** assert ***/
        Event::assertDispatched(ContactCheckedIn::class, function ($event) {
            return $event->contact->mobile == '+639173011987';
        });
    }
}

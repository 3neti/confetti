<?php

namespace Tests\Feature\Volunteer;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\Common\Actions\CreateContactAction;

class CreateContactActionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @var CreateContactAction */
    protected $action;

    public function setUp(): void
    {
        parent::setUp();

        $this->action = app(CreateContactAction::class);
    }

    /** @test */
    public function create_contact_action_works()
    {
        /*** arrange ***/
        $mobile = '09173011987';
        $handle = $this->faker->name;
        $attributes = null;

        /*** act ***/
        $contact = $this->action->run($mobile, $handle, $attributes);

        /*** assert ***/
        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertTrue($contact->wasRecentlyCreated);
        $this->assertEquals($mobile, $contact->mobile);
    }
}

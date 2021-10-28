<?php

namespace App\Domains\General\Events;

use App\Models\Post;
use App\Domains\Common\Events\ContactEvent;

class ContactReported extends ContactEvent
{
    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;

        parent::__construct($post->contact);
    }

    protected function log()
    {
        info("Contact {$this->contact->handle} ({$this->contact->mobile}) reported an incident in {$this->post->geotag['Neighborhood']} neighborhood.");
    }
}

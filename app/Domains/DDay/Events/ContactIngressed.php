<?php

namespace App\Domains\DDay\Events;

use App\Models\Post;
use App\Domains\Common\Events\ContactEvent;

class ContactIngressed extends ContactEvent
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;

        parent::__construct($post->contact);
    }

    protected function log()
    {
        info("Contact {$this->contact->handle} ({$this->contact->mobile}) ingressed with features [cluster => {$this->post->cluster}, bei => {$this->post->bei}, sealed => {$this->post->sealed}].");
    }
}

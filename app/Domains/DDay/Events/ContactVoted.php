<?php

namespace App\Domains\DDay\Events;

use App\Models\Post;
use App\Domains\Common\Events\ContactEvent;

class ContactVoted extends ContactEvent
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;

        parent::__construct($post->contact);
    }

    protected function log()
    {
        info("Contact {$this->contact->handle} ({$this->contact->mobile}) voted with features [duration => {$this->post->duration}, police => {$this->post->police}, military => {$this->post->military}].");
    }
}

<?php

namespace App\Domains\DDay\Events;

use App\Models\Post;
use App\Domains\Common\Events\ContactEvent;

class ContactTransmitted extends ContactEvent
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;

        parent::__construct($post->contact);
    }

    protected function log()
    {
        info("Contact {$this->contact->handle} ({$this->contact->mobile}) witnessed the transmission with features [printed => {$this->post->printed}, transmitted => {$this->post->transmitted}, retrieved => {$this->post->retrieved}].");
    }
}

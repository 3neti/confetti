<?php

namespace App\Domains\DDay\Events;

use App\Models\Post;
use App\Domains\Common\Events\ContactEvent;

class ContactEgressed extends ContactEvent
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;

        parent::__construct($post->contact);
    }

    protected function log()
    {
        info("Contact {$this->contact->handle} ({$this->contact->mobile}) egressed with features [candidate1 => {$this->post->candidate1}, candidate2 => {$this->post->candidate2}, candidate3 => {$this->post->candidate3}, candidate4 => {$this->post->candidate4}, candidate5 => {$this->post->candidate5}].");
    }
}

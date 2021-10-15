<?php

namespace App\Domains\DDay\Events;

use App\Models\Post;
use App\Domains\Common\Events\ContactEvent;

class ContactCounted extends ContactEvent
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;

        parent::__construct($post->contact);
    }

    protected function log()
    {
        info("Contact {$this->contact->handle} ({$this->contact->mobile}) voted the ff: candidates [president => {$this->post->president}, vice-president => {$this->post->vice_president}, governor => {$this->post->governor}, congressman => {$this->post->congressman}, mayor => {$this->post->mayor}].");
    }
}

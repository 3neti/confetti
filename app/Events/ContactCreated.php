<?php

namespace App\Events;

class ContactCreated extends ContactEvent
{
    protected function log()
    {
        info("Contact {$this->contact->handle} ({$this->contact->mobile}) is created.");
    }
}

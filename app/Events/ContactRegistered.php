<?php

namespace App\Events;

class ContactRegistered extends ContactEvent
{
    protected function log()
    {
        info("Contact {$this->contact->handle} ({$this->contact->mobile}) is registered.");
    }
}

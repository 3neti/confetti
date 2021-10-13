<?php

namespace App\Domains\Campaign\Events;

use App\Domains\Common\Events\ContactEvent;

class ContactRegistered extends ContactEvent
{
    protected function log()
    {
        info("Contact {$this->contact->handle} ({$this->contact->mobile}) is registered.");
    }
}

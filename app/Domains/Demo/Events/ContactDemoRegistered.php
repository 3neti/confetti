<?php

namespace App\Domains\Demo\Events;

use App\Domains\Common\Events\ContactEvent;

//deprecate
class ContactDemoRegistered extends ContactEvent
{
    protected function log()
    {
        info("Contact {$this->contact->handle} ({$this->contact->mobile}) is demo registered.");
    }
}

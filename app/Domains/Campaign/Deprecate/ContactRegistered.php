<?php

namespace App\Domains\Campaign\Deprecate;

use App\Domains\Common\Events\ContactEvent;

//deprecate
class ContactRegistered extends ContactEvent
{
    protected function log()
    {
        info("Contact {$this->contact->handle} ({$this->contact->mobile}) is registered.");
    }
}

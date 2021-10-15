<?php

namespace App\Domains\DDay\Events;

use App\Domains\Common\Events\ContactEvent;

class ContactVolunteered extends ContactEvent
{
    protected function log()
    {
        info("Contact {$this->contact->handle} ({$this->contact->mobile}) voluntered.");
    }
}

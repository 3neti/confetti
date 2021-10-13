<?php

namespace App\Events;

use App\Models\Checkin;
use App\Models\Contact;

class ContactCheckedin extends ContactEvent
{
    protected $checkin;

    public function __construct(Checkin $checkin)
    {
        $this->checkin = $checkin;

        parent::__construct($checkin->contact);
    }

    protected function log()
    {
        info("Contact {$this->contact->handle} ({$this->contact->mobile}) checked in at [{$this->checkin->longitude}, {$this->checkin->latitude}].");
    }
}

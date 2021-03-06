<?php

namespace App\Domains\DDay\Events;

use App\Domains\DDay\Models\Checkin;
use App\Domains\Common\Events\ContactEvent;

class ContactCheckedIn extends ContactEvent
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

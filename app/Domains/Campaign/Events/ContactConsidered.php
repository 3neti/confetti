<?php

namespace App\Domains\Campaign\Events;

use App\Domains\Common\Events\ContactEvent;
use App\Models\Campaign;

class ContactConsidered extends ContactEvent
{
    protected $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;

        parent::__construct($campaign->contact);
    }

    protected function log()
    {
        info("Contact {$this->contact->handle} ({$this->contact->mobile}) was considering.");
    }
}

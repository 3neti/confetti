<?php

namespace App\Domains\Campaign\Listeners;

use App\Models\Contact;
use App\Domains\Common\Events\ContactCreated;
use App\Domains\Campaign\Notifications\Welcome;
use Lorisleiva\Actions\Concerns\AsAction;

class SendCampaignWelcome
{
    use AsAction;

    public function handle(Contact $contact)
    {
        $contact->notify(new Welcome);
    }

    public function asListener(ContactCreated $event): void
    {
        $this->handle($event->contact);
    }
}

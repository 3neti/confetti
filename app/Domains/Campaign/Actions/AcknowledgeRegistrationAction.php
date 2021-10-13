<?php

namespace App\Domains\Campaign\Actions;

use App\Models\Contact;
use App\Domains\Common\Events\ContactCreated;
use App\Domains\Campaign\Notifications\AcknowledgeRegistration;
use Lorisleiva\Actions\Concerns\AsAction;

class AcknowledgeRegistrationAction
{
    use AsAction;

    public function handle(Contact $contact)
    {
        $contact->notify(new AcknowledgeRegistration);
    }

    public function asListener(ContactCreated $event): void
    {
        $this->handle($event->contact);
    }
}

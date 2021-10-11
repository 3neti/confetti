<?php

namespace App\Actions;

use App\Models\Contact;
use App\Events\ContactCreated;
use App\Notifications\AcknowledgeRegistration;
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

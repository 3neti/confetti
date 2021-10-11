<?php

namespace App\Actions;

use App\Models\Contact;
use App\Events\ContactRegistered;
use App\Notifications\TopupRegistrant;
use Lorisleiva\Actions\Concerns\AsAction;

class TopupRegistrantAction
{
    use AsAction;

    public function handle(Contact $contact)
    {
        $contact->notify((new TopupRegistrant)->setAmount(50));
    }

    public function asListener(ContactRegistered $event): void
    {
        $this->handle($event->contact);
    }
}

<?php

namespace App\Actions;

use App\Models\Contact;
use App\Events\ContactEvent;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Notifications\TopupContact as TopupContactInstruction;

abstract class TopupContact
{
    use AsAction;

    public function handle(Contact $contact)
    {
        $contact->notify((new TopupContactInstruction)->setAmount($this->getAmount()));
    }

    public function asListener(ContactEvent $event): void
    {
        $this->handle($event->contact);
    }

    abstract protected function getAmount(): int;
}

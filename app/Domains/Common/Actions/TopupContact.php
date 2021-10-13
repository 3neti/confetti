<?php

namespace App\Domains\Common\Actions;

use App\Models\Contact;
use App\Domains\Common\Events\ContactEvent;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Domains\Common\Notifications\TopupContact as TopupContactInstruction;

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

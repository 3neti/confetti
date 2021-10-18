<?php

namespace App\Domains\Common\Listeners;

use App\Models\Contact;
use App\Enums\DDayStage;
use App\Exceptions\DDayConstantException;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Domains\Common\Notifications\Link;
use App\Domains\Common\Events\ContactEvent;

abstract class BaseLinkContactListenerAction
{
    use AsAction;

    public function handle(Contact $contact)
    {
        $contact->notify((new Link)->setMessage($this->getMessage())
        );
    }

    public function asListener(ContactEvent $event): void
    {
        $this->handle($event->contact);
    }

    abstract protected function getMessage(): string;
}

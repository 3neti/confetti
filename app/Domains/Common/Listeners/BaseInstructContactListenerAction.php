<?php

namespace App\Domains\Common\Listeners;

use App\Models\Contact;
use App\Exceptions\DDayConstantException;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Domains\Common\Events\ContactEvent;
use App\Domains\Common\Notifications\Instructions;

abstract class BaseInstructContactListenerAction
{
    use AsAction;

    public function handle(Contact $contact)
    {
        $contact->notify((new Instructions)->setMessage($this->getMessage())
        );
    }

    public function asListener(ContactEvent $event): void
    {
        $this->handle($event->contact);
    }

    protected function getMessage(): string
    {
        if (!defined('static::STAGE')) throw new DDayConstantException;

        return trans('confetti.dday.instructions')[static::STAGE];
    }
}

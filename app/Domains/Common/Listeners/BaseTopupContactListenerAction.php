<?php

namespace App\Domains\Common\Listeners;

use App\Models\Contact;
use App\Exceptions\DDayConstantException;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Domains\Common\Events\ContactEvent;
use App\Domains\Common\Notifications\Topup;

abstract class BaseTopupContactListenerAction
{
    use AsAction;

    public function handle(Contact $contact)
    {
        $contact->notify(
            (new Topup())
                ->setAmount($this->getAmount())
        );
    }

    public function asListener(ContactEvent $event): void
    {
        $this->handle($event->contact);
    }

    protected function getAmount(): int
    {
        if (!defined('static::STAGE')) {
            throw new DDayConstantException;
        }

        return config('confetti.dday.topup')[static::STAGE];
    }
}

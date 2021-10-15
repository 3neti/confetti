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

    protected function getMessage(): string
    {
        if (!defined('static::STAGE')) {
            throw new DDayConstantException;
        }
        $stage = DDayStage::fromValue(static::STAGE);
        $name = $stage->key;
        $description = $stage->description;
        $link = config('confetti.dday.link')[$stage->value];

        return trans('confetti.dday.link', compact('name', 'description', 'link'));
    }
}

<?php

namespace App\Domains\Common\Listeners;

use App\Models\Contact;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Domains\Common\Events\ContactEvent;
use App\Domains\Common\Notifications\Remarks;

class ClosingRemarks
{
    use AsAction;

    public function handle(Contact $contact)
    {
        $contact->notify((new Remarks())->setMessage($this->getMessage())
        );
    }

    public function asListener(ContactEvent $event): void
    {
        $this->handle($event->contact);
    }

    protected function getMessage(): string
    {
        return trans('confetti.remarks.closing');
    }
}

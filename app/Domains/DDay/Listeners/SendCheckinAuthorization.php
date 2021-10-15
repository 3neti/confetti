<?php

namespace App\Domains\DDay\Listeners;

use Hash;
use App\Models\Contact;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Domains\DDay\Events\ContactCheckedIn;
use App\Domains\DDay\Notifications\Authorization;

class SendCheckinAuthorization
{
    use AsAction;

    public function handle(Contact $contact)
    {
        $pin = $this->generatePIN($contact);
        $contact->notify((new Authorization)->setPIN($pin));
    }

    public function asListener(ContactCheckedIn $event): void
    {
        $this->handle($event->contact);
    }

    protected function generatePIN(Contact $contact): int
    {
        $pin = random_int(1000, 9999);
        $contact->pin = Hash::make($pin);
        $contact->save();

        return $pin;
    }
}

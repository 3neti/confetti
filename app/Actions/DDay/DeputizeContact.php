<?php

namespace App\Actions\DDay;

use Hash;
use App\Models\Contact;
use App\Events\ContactCheckedin;
use App\Notifications\SendContactPIN;
use Lorisleiva\Actions\Concerns\AsAction;

class DeputizeContact
{
    use AsAction;

    public function handle(Contact $contact)
    {
        $pin = $this->getPIN($contact);
        $contact->notify((new SendContactPIN)->setPIN($pin));
    }

    public function asListener(ContactCheckedin $event): void
    {
        $this->handle($event->contact);
    }

    protected function getPIN(Contact $contact): int
    {
        $pin = random_int(1000, 9999);
        $contact->pin = Hash::make($pin);
        $contact->save();

        return $pin;
    }
}

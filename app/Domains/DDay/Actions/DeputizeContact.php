<?php

namespace App\Domains\DDay\Actions;

use Hash;
use App\Models\Contact;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Domains\DDay\Events\ContactCheckedin;
use App\Domains\DDay\Notifications\SendContactPIN;

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

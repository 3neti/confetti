<?php

namespace App\Domains\Common\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use LBHurtado\Missive\Repositories\ContactRepository;

class CreateContactAction
{
    use AsAction;

    public function handle($mobile, $handle, array $extra_attributes = null)
    {
        $contact = app(ContactRepository::class)
            ->firstOrCreate(compact('mobile', 'handle'));
        if (null != $extra_attributes) {
            $contact->extra_attributes = $extra_attributes;
            $contact->save();
        }

        return $contact;
    }
}

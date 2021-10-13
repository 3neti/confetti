<?php

namespace App\Domains\DDay\Actions;

use App\Domains\DDay\Models\Checkin;
use Lorisleiva\Actions\Concerns\AsAction;
use LBHurtado\Missive\Repositories\ContactRepository;

class CheckinContactAction
{
    use AsAction;

    public function handle($mobile, $longitude, $latitude)
    {
        $contact = app(ContactRepository::class)
            ->firstOrCreate(compact('mobile'));
        $checkin = Checkin::make(compact('longitude', 'latitude'));
        $checkin->contact()->associate($contact);
        $checkin->save();

        return $checkin;
    }
}

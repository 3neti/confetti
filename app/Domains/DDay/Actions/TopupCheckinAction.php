<?php

namespace App\Domains\DDay\Actions;

use App\Domains\Common\Actions\TopupContact;

class TopupCheckinAction extends TopupContact
{
    protected function getAmount(): int
    {
        return config('confetti.topup.checkin');
    }
}

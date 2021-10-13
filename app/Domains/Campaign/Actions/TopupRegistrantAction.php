<?php

namespace App\Domains\Campaign\Actions;

use App\Domains\Common\Actions\TopupContact;

class TopupRegistrantAction extends TopupContact
{
    protected function getAmount(): int
    {
        return config('confetti.topup.registration');
    }
}

<?php

namespace App\Actions;

class TopupCheckinAction extends TopupContact
{
    protected function getAmount(): int
    {
        return config('confetti.topup.checkin');
    }
}

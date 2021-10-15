<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static CHECKIN()
 * @method static static INGRESS()
 * @method static static VOTE()
 * @method static static COUNT()
 * @method static static TRANSMISSION()
 * @method static static EGRESS()
 */
final class DDayStage extends Enum implements LocalizedEnum
{
    const CHECKIN = 'Check In';
    const INGRESS = 'Ingress';
    const VOTE = 'Vote';
    const COUNT = 'Count';
    const TRANSMISSION = 'Transmission';
    const EGRESS = 'Egress';
}

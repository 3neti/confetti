<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static CHECKIN()
 * @method static static INGRESS()
 * @method static static VOTE()
 */
final class PostType extends Enum
{
    const CHECKIN = 'Check In';
    const INGRESS = 'Ingress';
    const VOTE = 'Vote';
}

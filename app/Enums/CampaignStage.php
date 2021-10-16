<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static AWARENESS()
 * @method static static INTEREST()
 * @method static static CONSIDERATION()
 * @method static static EVALUATION()
 * @method static static DECISION()
 * @method static static CONVERSION()
 * @method static static RETENTION()
 * @method static static LOYALTY()
 * @method static static ADVOCACY()
 */
final class CampaignStage extends Enum
{
    const AWARENESS = 'Awareness';
    const INTEREST = 'Interest';
    const CONSIDERATION = 'Consideration';
    const EVALUATION = 'Evaluation';
    const DECISION = 'Decision';
    const CONVERSION = 'Conversion'; //Purchase
    const RETENTION = 'Retention'; //Repeat
    const LOYALTY = 'Loyalty';
    const ADVOCACY = 'Advocacy';
}

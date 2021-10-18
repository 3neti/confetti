<?php

namespace App\Domains\Campaign\Http\Controllers;

use App\Enums\CampaignStage;

class ConversionController extends CampaignController
{
    protected $stage = CampaignStage::CONVERSION;
}

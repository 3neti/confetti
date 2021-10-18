<?php

namespace App\Domains\Campaign\Http\Controllers;

use App\Enums\CampaignStage;

class InterestController extends CampaignController
{
    protected $stage = CampaignStage::INTEREST;
}

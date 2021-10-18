<?php

namespace App\Domains\Campaign\Http\Controllers;

use App\Enums\CampaignStage;

class DecisionController extends CampaignController
{
    protected $stage = CampaignStage::DECISION;
}

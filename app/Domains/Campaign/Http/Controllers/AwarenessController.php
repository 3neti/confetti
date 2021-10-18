<?php

namespace App\Domains\Campaign\Http\Controllers;

use App\Enums\CampaignStage;

class AwarenessController extends CampaignController
{
    protected $stage = CampaignStage::AWARENESS;
}

<?php

namespace App\Domains\Campaign\Http\Controllers;

use App\Enums\CampaignStage;

class ConsiderationController extends CampaignController
{
    protected $stage = CampaignStage::CONSIDERATION;
}

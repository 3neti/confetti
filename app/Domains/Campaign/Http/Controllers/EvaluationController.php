<?php

namespace App\Domains\Campaign\Http\Controllers;

use App\Enums\CampaignStage;

class EvaluationController extends CampaignController
{
    protected $stage = CampaignStage::EVALUATION;
}

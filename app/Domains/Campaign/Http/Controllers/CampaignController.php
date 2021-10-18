<?php

namespace App\Domains\Campaign\Http\Controllers;

use Illuminate\Http\Request;
use Coreproc\MsisdnPh\Msisdn;
use App\Http\Controllers\Controller;
use App\Domains\Campaign\Actions\ContactCampaignAction;
use App\Domains\Campaign\Http\Resources\CampaignResource;

abstract class CampaignController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return CampaignResource
     */
    public function __invoke(Request $request)
    {
        /*** attest ***/
        $validated = $this->getValidatedData($request);

        /*** arrange ***/
        $mobile = $this->getFormattedMobile($validated['mobile']);
        unset($validated['mobile']);

        /*** act ***/
        $campaign = ContactCampaignAction::run($mobile, $this->stage, $validated);
        $event = $this->getCampaignEvent();
        event(new $event($campaign));

        /*** answer ***/
        return new CampaignResource(collect(compact('campaign')));
    }

    protected function getFormattedMobile($mobile)
    {
        return (new Msisdn($mobile))->get(true);
    }

    protected function getRules() //override
    {
        return config('confetti.campaign.fields')[$this->stage];
    }

    protected function getCampaignEvent()
    {
        return config('confetti.campaign.event')[$this->stage];
    }
}

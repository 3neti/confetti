<?php

namespace App\Domains\General\Http\Controllers;

use App\Domains\DDay\Actions\ContactIngressAction;
use App\Domains\General\Actions\ContactIncidentAction;
use App\Domains\General\Events\ContactReported;
use App\Enums\DDayStage;
use Illuminate\Http\Request;
use Coreproc\MsisdnPh\Msisdn;
use App\Http\Controllers\Controller;
use LBHurtado\Missive\Repositories\ContactRepository;

class IncidentController extends Controller
{
    protected $rules = [
        'mobile' => 'required',
        'incident' => 'required',
        'action' => 'required',
        'remarks' => 'string',
        'geotag' => 'required',
    ];

    public function __invoke(Request $request)
    {
        /*** attest ***/
        $validated = $this->getValidatedData($request);

        /*** arrange ***/
        $mobile = $this->getFormattedMobile($validated['mobile']);

        $incident = $validated['incident'];

        $action = $validated['action'];
        $remarks = $validated['remarks'] ?? '';
        $geotag = $validated['geotag'];
        $array = explode("\r\n", $geotag);
        $datetime = array_shift($array);
        $geotag = ['Datetime' => $datetime];
        foreach ($array as $row) {
            $data = explode(': ', $row);
            try {
                $geotag[$data[0]] = $data[1];
            } catch (\Exception $exception) {

            }
        }

        /*** act ***/
        $post = ContactIncidentAction::run($mobile, DDayStage::INCIDENT,
            compact('incident', 'action', 'remarks', 'geotag'));
        event(new ContactReported($post));

        /*** answer ***/
        return response($post, 202);
    }

    protected function getFormattedMobile($mobile)//TODO: put this in main controller ancestor
    {
        if (is_array($mobile)) {
            $mobile = array_values($mobile)[0];
        }

        return (new Msisdn($mobile))->get(true);
    }
}

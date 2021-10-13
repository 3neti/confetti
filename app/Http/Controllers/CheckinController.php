<?php

namespace App\Http\Controllers;

use App\Actions\DDay\CheckinContactAction;
use App\Events\ContactCheckedin;
use App\Http\Resources\CheckinResource;
use Validator;
use Coreproc\MsisdnPh\Msisdn;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    protected $rules = [
        'mobile' => 'required',
        'location' => 'required',
    ];

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        /*** attest ***/
        $data = $this->getData($request);
        $validated = Validator::validate($data, $this->rules);

        /*** arrange ***/
        $mobile = (new Msisdn($validated['mobile']))
            ->get(true);
        $longitude = null;
        $latitude = null;
        extract($this->getLocation($validated['location']));

        /*** act ***/
        $checkin = CheckinContactAction::run($mobile, $longitude, $latitude);
        ContactCheckedin::dispatch($checkin);

        /*** answer ***/
        return new CheckinResource(collect(compact('checkin')));
    }

    protected function getLocation($data)
    {
        $location = explode("\n", $data);
        $longitude = (float) substr($location[0], strpos($location[0], " ") + 1);
        $latitude = (float) substr($location[1], strpos($location[1], " ") + 1);

        return compact('longitude', 'latitude');
    }
}

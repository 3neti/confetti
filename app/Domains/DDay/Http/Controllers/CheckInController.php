<?php

namespace App\Domains\DDay\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Coreproc\MsisdnPh\Msisdn;
use App\Http\Controllers\Controller;
use App\Domains\DDay\Events\ContactCheckedIn;
use App\Domains\DDay\Actions\ContactCheckInAction;
use App\Domains\DDay\Http\Resources\CheckInResource;

class CheckInController extends Controller
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
        $checkin = ContactCheckInAction::run($mobile, $longitude, $latitude);
        ContactCheckedIn::dispatch($checkin);

        /*** answer ***/
        return new CheckInResource(collect(compact('checkin')));
    }

    protected function getLocation($data)
    {
        $location = explode("\n", $data);
        $longitude = (float) substr($location[0], strpos($location[0], " ") + 1);
        $latitude = (float) substr($location[1], strpos($location[1], " ") + 1);

        return compact('longitude', 'latitude');
    }
}

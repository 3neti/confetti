<?php

namespace App\Domains\DDay\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Coreproc\MsisdnPh\Msisdn;
use App\Http\Controllers\Controller;
use App\Domains\DDay\Events\ContactVolunteered;
use App\Domains\Common\Actions\CreateContactAction;
use App\Domains\DDay\Http\Resources\VolunteerResource;

class VolunteerController extends Controller
{
    protected $rules = [
        'from' => 'required',
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
//        $data = $this->getData($request);
//        $validated = Validator::validate($data, $this->rules);

        /*** arrange ***/
//        $mobile = (new Msisdn($validated['from']))
//            ->get(true);
        $mobile = $request->getContent();//using Telerivet
        $handle = 'Volunteer';

        /*** act ***/
        $contact = CreateContactAction::run($mobile, $handle);
        ContactVolunteered::dispatch($contact);

        /*** answer ***/
        return new VolunteerResource(collect(compact('contact')));
    }
}

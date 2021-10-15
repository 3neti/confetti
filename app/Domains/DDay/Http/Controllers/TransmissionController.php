<?php

namespace App\Domains\DDay\Http\Controllers;

use Validator;
use App\Enums\DDayStage;
use Illuminate\Http\Request;
use Coreproc\MsisdnPh\Msisdn;
use App\Http\Controllers\Controller;
use App\Domains\DDay\Events\ContactTransmitted;
use App\Domains\DDay\Actions\ContactTransmissionAction;
use App\Domains\DDay\Http\Resources\TransmissionResource;

class TransmissionController extends Controller
{
    protected $rules = [
        'mobile' => 'required',
        'pin' => 'required',
        'printed' => 'required',
        'transmitted' => 'required',
        'retrieved' => 'required',
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
        $mobile = (new Msisdn($validated['mobile']))->get(true);
        $pin = (int) $validated['pin'];
        $printed = (bool) $validated['printed'];
        $transmitted = (bool) $validated['transmitted'];
        $retrieved = (bool) $validated['retrieved'];

        /*** act ***/
        $post = ContactTransmissionAction::run($mobile, DDayStage::TRANSMISSION, compact('printed', 'transmitted', 'retrieved'));
        ContactTransmitted::dispatch($post);

        /*** answer ***/
        return new TransmissionResource(collect(compact('post')));
    }
}

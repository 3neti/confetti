<?php

namespace App\Domains\DDay\Http\Controllers;

use Validator;
use App\Enums\DDayStage;
use Illuminate\Http\Request;
use Coreproc\MsisdnPh\Msisdn;
use App\Http\Controllers\Controller;
use App\Domains\DDay\Events\ContactEgressed;
use App\Domains\DDay\Actions\ContactEgressAction;
use App\Domains\DDay\Http\Resources\EgressResource;

class EgressController extends Controller
{
    protected $rules = [
        'mobile' => 'required',
        'pin' => 'required',
        'candidate1' => 'required|int',
        'candidate2' => 'required|int',
        'candidate3' => 'required|int',
        'candidate4' => 'required|int',
        'candidate5' => 'required|int'
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
        $candidate1 = (int) $validated['candidate1'];
        $candidate2 = (int) $validated['candidate2'];
        $candidate3 = (int) $validated['candidate3'];
        $candidate4 = (int) $validated['candidate4'];
        $candidate5 = (int) $validated['candidate5'];

        /*** act ***/
        $post = ContactEgressAction::run($mobile, DDayStage::EGRESS, compact('candidate1', 'candidate2', 'candidate3', 'candidate4', 'candidate5'));
        ContactEgressed::dispatch($post);

        /*** answer ***/
        return new EgressResource(collect(compact('post')));
    }
}

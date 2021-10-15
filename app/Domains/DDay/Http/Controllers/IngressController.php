<?php

namespace App\Domains\DDay\Http\Controllers;

use Validator;
use App\Enums\DDayStage;
use Illuminate\Http\Request;
use Coreproc\MsisdnPh\Msisdn;
use App\Http\Controllers\Controller;
use App\Domains\DDay\Events\ContactIngressed;
use App\Domains\DDay\Actions\ContactIngressAction;
use App\Domains\DDay\Http\Resources\IngressResource;

class IngressController extends Controller
{
    protected $rules = [
        'mobile' => 'required',
        'pin' => 'required|int',
        'cluster' => 'required',
        'bei' => 'required',
        'sealed' => 'required'
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
        $cluster = $validated['cluster'];
        $bei = $validated['bei'];
        $sealed = (bool) $validated['sealed'];

        /*** act ***/
        $post = ContactIngressAction::run($mobile, DDayStage::INGRESS, compact('cluster', 'bei', 'sealed'));
        ContactIngressed::dispatch($post);

        /*** answer ***/
        return new IngressResource(collect(compact('post')));
    }
}

<?php

namespace App\Domains\DDay\Http\Controllers;

use Validator;
use App\Enums\DDayStage;
use Illuminate\Http\Request;
use Coreproc\MsisdnPh\Msisdn;
use App\Http\Controllers\Controller;
use App\Domains\DDay\Events\ContactCounted;
use App\Domains\DDay\Actions\ContactCountAction;
use App\Domains\DDay\Http\Resources\CountResource;

class CountController extends Controller
{
    protected $rules = [
        'mobile' => 'required',
        'pin' => 'required',
        'president' => 'required',
        'vicepresident' => 'required',
        'governor' => 'nullable',
        'congressman' => 'required',
        'mayor' => 'required'
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
        $president = $validated['president'];
        $vicepresident = $validated['vicepresident'];
        $governor = $validated['governor'];
        $congressman = $validated['congressman'];
        $mayor = $validated['mayor'];

        /*** act ***/
        $post = ContactCountAction::run($mobile, DDayStage::COUNT, compact('president', 'vicepresident', 'governor', 'congressman', 'mayor'));
        ContactCounted::dispatch($post);

        /*** answer ***/
        return new CountResource(collect(compact('post')));
    }
}

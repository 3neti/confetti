<?php

namespace App\Domains\Demo\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Coreproc\MsisdnPh\Msisdn;
use App\Http\Controllers\Controller;
use App\Domains\Demo\Events\ContactDemoRegistered;
use App\Domains\Common\Actions\CreateContactAction;
use App\Domains\Demo\Http\Resources\DemoRegisterResource;

class DemoRegisterController extends Controller
{
    /**
     * @var string[]
     */
    protected $rules = [
        'applicationType' => 'required',
        'ageGeneration' => 'required',
        'gcashMobile' =>  'required|msisdn',
        'gcashName' => 'required',
    ];

    /**
     * @param Request $request
     * @return DemoRegisterResource
     * @throws \Coreproc\MsisdnPh\Exceptions\InvalidMsisdnException
     */
    public function __invoke(Request $request)
    {
        /*** attest ***/
        $data = $this->getData($request);
        $validated = Validator::validate($data, $this->rules);

        /*** arrange ***/
        $mobile = (new Msisdn($validated['gcashMobile']))->get(true);
        $handle = $validated['gcashName'];
        $registration = [
            'comelec' => [
                'applicationType' => $validated['applicationType']
            ]
        ];
        $ageGeneration = $validated['ageGeneration'];
        $extra_attributes = compact('ageGeneration', 'registration');

        /*** act ***/
        $contact = CreateContactAction::run($mobile, $handle, $extra_attributes);
        ContactDemoRegistered::dispatch($contact);

        /*** answer ***/
        return (new DemoRegisterResource(collect(compact('contact'))));
    }
}

<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Coreproc\MsisdnPh\Msisdn;
use App\Events\ContactRegistered;
use App\Actions\CreateContactAction;
use App\Http\Resources\GoOutAndRegisterResource;

class GoOutAndRegisterController extends Controller
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
     * @return GoOutAndRegisterResource
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
        ContactRegistered::dispatch($contact);

        /*** answer ***/
        return (new GoOutAndRegisterResource(collect(compact('contact'))));
    }
}

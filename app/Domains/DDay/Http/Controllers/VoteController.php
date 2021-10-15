<?php

namespace App\Domains\DDay\Http\Controllers;

use Validator;
use App\Enums\DDayStage;
use Illuminate\Http\Request;
use Coreproc\MsisdnPh\Msisdn;
use App\Http\Controllers\Controller;
use App\Domains\DDay\Http\Resources\VoteResource;
use App\Domains\DDay\Events\ContactVoted;
use App\Domains\DDay\Actions\ContactVoteAction;

class VoteController extends Controller
{
    protected $rules = [
        'mobile' => 'required',
        'pin' => 'required',
        'duration' => 'required:int',
        'police' => 'required',
        'military' => 'required'
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
        $duration = (int) $validated['duration'];
        $police = (bool) $validated['police'];
        $military = (bool) $validated['military'];

        /*** act ***/
        $post = ContactVoteAction::run($mobile, DDayStage::VOTE, compact('duration', 'police', 'military'));
        ContactVoted::dispatch($post);

        /*** answer ***/
        return new VoteResource(collect(compact('post')));
    }
}

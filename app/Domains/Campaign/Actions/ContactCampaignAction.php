<?php

namespace App\Domains\Campaign\Actions;

use App\Models\Campaign;
use Lorisleiva\Actions\Concerns\AsAction;
use LBHurtado\Missive\Repositories\ContactRepository;

class ContactCampaignAction
{
    use AsAction;

    public function handle($mobile, $type, array $features = null)
    {
        $contact = app(ContactRepository::class)->firstOrCreate(compact('mobile'));
        $campaign = Campaign::make(compact('type', 'features'));
        $campaign->contact()->associate($contact);
        $campaign->save();

        return $campaign;
    }
}

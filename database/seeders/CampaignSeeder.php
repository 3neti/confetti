<?php

namespace Database\Seeders;

use App\Enums\CampaignStage;
use Illuminate\Database\Seeder;
use App\Models\{Contact, Campaign};

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contact = Contact::firstOrcreate(['mobile' => '09173011987']);
        $campaign = Campaign::make(['type' => CampaignStage::AWARENESS()]);
        $campaign->contact()->associate($contact);
        $campaign->age = 18;
        $campaign->gender = 'Male';
        $campaign->lgu = 'Quezon City';
        $campaign->precinct = 'A001';
        $campaign->save();
    }
}

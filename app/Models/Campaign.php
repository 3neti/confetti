<?php

namespace App\Models;

use App\Enums\CampaignStage;
use App\Traits\HasCampaignFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory, HasCampaignFeatures;

    protected $fillable = [
        'type',
        'features',
    ];

    protected $casts = [
        'type' => CampaignStage::class,
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}

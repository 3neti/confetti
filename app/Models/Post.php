<?php

namespace App\Models;

use App\Enums\DDayStage;
use App\Enums\PostType;
use App\Traits\HasPostFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, HasPostFeatures;

    protected $fillable = [
        'type'
    ];

    protected $casts = [
        'type' => DDayStage::class,
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}

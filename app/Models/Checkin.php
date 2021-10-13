<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;

    protected $fillable = [
        'longitude',
        'latitude',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}

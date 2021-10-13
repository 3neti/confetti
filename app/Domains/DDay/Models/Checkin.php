<?php

namespace App\Domains\DDay\Models;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

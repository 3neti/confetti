<?php

namespace App\Models;

use App\Events\ContactCreated;
use Illuminate\Notifications\Notifiable;
use LBHurtado\Missive\Models\Contact as BaseContact;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends BaseContact
{
    use HasFactory, Notifiable;

    protected $dispatchesEvents = [
        'created' => ContactCreated::class
    ];

    public function routeNotificationForEngageSpark()
    {
        return $this->mobile;
    }
}

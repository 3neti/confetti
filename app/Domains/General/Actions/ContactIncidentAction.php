<?php

namespace App\Domains\General\Actions;

use App\Domains\DDay\Actions\ContactCheckInAction;
use App\Domains\DDay\Events\ContactCheckedIn;
use App\Models\Post;
use Lorisleiva\Actions\Concerns\AsAction;
use LBHurtado\Missive\Repositories\ContactRepository;

class ContactIncidentAction
{
    use AsAction;

    public function handle($mobile, $type, $features)
    {
//        $contact = app(ContactRepository::class)->where(compact('mobile'))->firstOrFail();
        $contact = app(ContactRepository::class)
            ->firstOrCreate(compact('mobile'));
        $post = Post::make(['type' => $type]);

        $post->contact()->associate($contact);
        $post->incident = $features['incident'];
        $post->action = $features['action'];
        $post->remarks = $features['remarks'];
        $post->geotag = $features['geotag'];
        $post->save();

//        ContactCheckInAction::dispatch($contact, $post->geotag['Longitude'], $post->geotag['Latitude']);

        return $post;
    }
}

<?php

namespace App\Domains\DDay\Actions;

use App\Models\Post;
use Lorisleiva\Actions\Concerns\AsAction;
use LBHurtado\Missive\Repositories\ContactRepository;

class ContactVoteAction
{
    use AsAction;

    public function handle($mobile, $type, $features)
    {
        $contact = app(ContactRepository::class)->where(compact('mobile'))->firstOrFail();
        $post = Post::make(['type' => $type]);
        $post->contact()->associate($contact);
        $post->duration = $features['duration'];
        $post->police = $features['police'];
        $post->military = $features['military'];
        $post->save();

        return $post;
    }
}

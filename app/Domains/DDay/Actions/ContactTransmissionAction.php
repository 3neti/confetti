<?php

namespace App\Domains\DDay\Actions;

use App\Models\Post;
use Lorisleiva\Actions\Concerns\AsAction;
use LBHurtado\Missive\Repositories\ContactRepository;

class ContactTransmissionAction
{
    use AsAction;

    public function handle($mobile, $type, $features)
    {
        $contact = app(ContactRepository::class)->where(compact('mobile'))->firstOrFail();
        $post = Post::make(['type' => $type]);
        $post->contact()->associate($contact);
        $post->printed = $features['printed'];
        $post->transmitted = $features['transmitted'];
        $post->retrieved = $features['retrieved'];
        $post->save();

        return $post;
    }
}

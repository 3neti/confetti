<?php

namespace App\Domains\DDay\Actions;

use App\Models\Post;
use Lorisleiva\Actions\Concerns\AsAction;
use LBHurtado\Missive\Repositories\ContactRepository;

class ContactIngressAction
{
    use AsAction;

    public function handle($mobile, $type, $features)
    {
        $contact = app(ContactRepository::class)->where(compact('mobile'))->firstOrFail();
        $post = Post::make(['type' => $type]);
        $post->contact()->associate($contact);
        $post->cluster = $features['cluster'];
        $post->bei = $features['bei'];
        $post->sealed = $features['sealed'];
        $post->save();

        return $post;
    }
}

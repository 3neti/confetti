<?php

namespace App\Domains\DDay\Actions;

use App\Models\Post;
use Lorisleiva\Actions\Concerns\AsAction;
use LBHurtado\Missive\Repositories\ContactRepository;

class ContactCountAction
{
    use AsAction;

    public function handle($mobile, $type, $features)
    {
        $contact = app(ContactRepository::class)->where(compact('mobile'))->firstOrFail();
        $post = Post::make(['type' => $type]);
        $post->contact()->associate($contact);
        $post->president = $features['president'];
        $post->vicepresident = $features['vicepresident'];
        $post->governor = $features['governor'];
        $post->congressman = $features['congressman'];
        $post->mayor = $features['mayor'];
        $post->save();

        return $post;
    }
}

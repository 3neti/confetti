<?php

namespace App\Domains\DDay\Actions;

use App\Models\Post;
use Lorisleiva\Actions\Concerns\AsAction;
use LBHurtado\Missive\Repositories\ContactRepository;

class ContactEgressAction
{
    use AsAction;

    public function handle($mobile, $type, $features)
    {
        $contact = app(ContactRepository::class)->where(compact('mobile'))->firstOrFail();
        $post = Post::make(['type' => $type]);
        $post->contact()->associate($contact);
        $post->candidate1 = $features['candidate1'];
        $post->candidate2 = $features['candidate2'];
        $post->candidate3 = $features['candidate3'];
        $post->candidate4 = $features['candidate4'];
        $post->candidate5 = $features['candidate5'];
        $post->save();

        return $post;
    }
}

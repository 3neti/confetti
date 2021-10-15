<?php

namespace Database\Seeders;

use App\Enums\PostType;
use App\Models\Contact;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contact = Contact::create(['mobile' => '09173011987']);
        $post = Post::make(['type' => PostType::INGRESS()]);
        $post->contact()->associate($contact);
        $post->cluster = '123456';
        $post->bei = 'Dr. Jeckyl';
        $post->sealed = true;
        $post->save();
    }
}

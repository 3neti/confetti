<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Contact;
use App\Enums\DDayStage;
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
        $contact = Contact::firstOrcreate(['mobile' => '09173011987']);
        $post = Post::make(['type' => DDayStage::INGRESS()]);
        $post->contact()->associate($contact);
        $post->cluster = '123456';
        $post->bei = 'Dr. Jeckyl';
        $post->sealed = true;
        $post->save();
    }
}

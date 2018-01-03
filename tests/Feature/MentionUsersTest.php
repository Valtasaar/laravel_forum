<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MentionUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function mentioned_users_in_a_reply_are_notified()
    {
        $dan = create('App\User', ['name' => 'Dan']);

        $this->signIn($dan);

        $dana = create('App\User', ['name' => 'Dana']);

        $thread = create('App\Thread');

        $reply = make('App\Reply', [
            'body' => '@Dana, look at this!'
        ]);

        $this->json('post', $thread->path() . '/replies', $reply->toArray());

        $this->assertCount(1, $dana->notifications);
    }
}
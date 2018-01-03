<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscribeToThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_subscribe_to()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $this->post($thread->path() . '/subscribes');

        $this->assertCount(1, $thread->subscribes);
    }

    /** @test */
    function a_user_can_unsubscribe_from()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $thread->subscribe();

        $this->delete($thread->path() . '/subscribes');

        $this->assertCount(0, $thread->subscribes);
    }
}
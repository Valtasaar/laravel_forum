<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

    function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    function testUserCanSeeThreads()
    {
        $this->get('/threads')->assertSee($this->thread->title);
    }

    function testUserCanSeeAThread()
    {
        $this->get("/threads/{$this->thread->channel->slug}/{$this->thread->id}")
                ->assertSee($this->thread->title);
    }

    function testUserCanReadReplies()
    {
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        $this->get("/threads/{$this->thread->channel->slug}/{$this->thread->id}")
            ->assertSee($reply->body);
    }
    
    function testAUserCanFilterAThreads()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    function testAUserCanFilterThreadsByUsername()
    {
        $this->signIn(create('App\User', ['name' => 'Dan']));

        $threadByDan = create('App\Thread', ['user_id' => auth()->id()]);
        $threadNotByDan = create('App\Thread');

        $this->get('/threads?by=Dan')
            ->assertSee($threadByDan->title)
            ->assertDontSee($threadNotByDan->title);
    }

    function testAUserCanFilterThreadsByPopularity()
    {
        $threadWithThreeRelies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithThreeRelies->id], 3);

        $threadWithTwoRelies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithTwoRelies->id], 2);

        $threadWithNotRelies = $this->thread;

        $response = $this->getJson('/threads?popular=1')->json();

        $this->assertEquals([3,2,0], array_column($response, 'replies_count'));
    }
}

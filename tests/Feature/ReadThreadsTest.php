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

    /** @test */
    function user_can_see_threads()
    {
        $this->get('/threads')->assertSee($this->thread->title);
    }

    /** @test */
    function user_can_see_a_thread()
    {
        $this->get("/threads/{$this->thread->channel->slug}/{$this->thread->id}")
                ->assertSee($this->thread->title);
    }

    /** @test */
    function user_can_read_replies()
    {
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        $this->get("/threads/{$this->thread->channel->slug}/{$this->thread->id}")
            ->assertSee($reply->body);
    }

    /** @test */
    function a_user_can_filter_a_threads_according_to_a_channel()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    /** @test */
    function a_user_can_filter_threads_by_username()
    {
        $this->signIn(create('App\User', ['name' => 'Dan']));

        $threadByDan = create('App\Thread', ['user_id' => auth()->id()]);
        $threadNotByDan = create('App\Thread');

        $this->get('/threads?by=Dan')
            ->assertSee($threadByDan->title)
            ->assertDontSee($threadNotByDan->title);
    }

    /** @test */
    function a_user_can_filter_threads_by_popularity()
    {
        $threadWithThreeRelies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithThreeRelies->id], 3);

        $threadWithTwoRelies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithTwoRelies->id], 2);

        $threadWithNotReplies = $this->thread;

        $response = $this->getJson('/threads?popular=1')->json();

        $this->assertEquals([3,2,0], array_column($response, 'replies_count'));
    }

    /** @test */
    function a_user_can_filter_threads_by_those_that_are_unanswered()
    {
        $thread = create('App\Thread');
        create('App\Reply', ['thread_id' => $thread->id]);

        $response = $this->getJson('/threads?unanswered=1')->json();

        $this->assertCount(1, $response);
    }

    /** @test */
    function a_u_ser_can_request_all_replies_for_a_given_thread()
    {
        $thread = create('App\Thread');

        create('App\Reply', ['thread_id' => $thread->id], 2);

        $response = $this->getJson($thread->path() . '/replies')->json();

        $this->assertCount(2, $response['data']);
        $this->assertEquals(2, $response['total']);
    }
}

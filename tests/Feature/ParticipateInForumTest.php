<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;



class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    function testUnauthenticatedUsersMayNotAddReplies()
    {
        $this->withExceptionHandling()
            ->post('/threads/channel/1/replies', [])
            ->assertRedirect('/login');
    }

    function testAnAuthenticatedUserCanRockTheForum()
    {
        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply');

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())->assertSee($reply->body);
    }
    
    function testAReplyRequiresABody()
    {
        $this->withExceptionHandling()->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    function testUnauthorizedUsersCannotDeleteReplies()
    {
        $this->withExceptionHandling();

        $reply = create('App\Reply');

        $this->delete('/replies/' . $reply->id)
            ->assertRedirect('/login');

        $this->signIn()->delete('/replies/' . $reply->id)
            ->assertStatus(403);
    }

    function testAuthorizedUsersCanDeleteReplies()
    {
        $this->signIn();

        $reply = create('App\Reply', ['user_id' => auth()->id()]);

        $this->delete('/replies/' . $reply->id)->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    function testUnauthorizedUsersCannotUpdateReplies()
    {
        $this->withExceptionHandling();

        $reply = create('App\Reply');

        $this->patch('/replies/' . $reply->id)
            ->assertRedirect('/login');

        $this->signIn()->patch('/replies/' . $reply->id)
            ->assertStatus(403);
    }

    function testAuthorizedUsersCanUpdateReplies()
    {
        $this->signIn();

        $body = 'A new body';

        $reply = create('App\Reply', ['user_id' => auth()->id()]);

        $this->patch('/replies/' . $reply->id, ['body' => $body]);

        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => $body]);
    }
}

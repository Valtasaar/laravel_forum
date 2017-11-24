<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;

    public function testAUserHasAProfile()
    {
        $user = create('App\User');

        $this->get('/profile/' . $user->name)
            ->assertSee($user->name);
    }
    
    function testProfileDisplayAllThreadsByUser()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->get('/profile/' . auth()->user()->name)
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
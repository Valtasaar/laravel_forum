<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelTest extends TestCase
{
    use RefreshDatabase;

    public function testAChannelConsistOfThreads()
    {
        $cannel = create('App\Channel');
        $thread = create('App\Thread', ['channel_id' => $cannel->id]);

        $this->assertTrue($cannel->threads->contains($thread));
    }
}

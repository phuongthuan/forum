<?php

namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubcribeToThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_subcribe_to_threads()
    {
        $this->signIn();

        //Given we have a thread.
        $thread = create(Thread::class);

        //When the user subcribes to the thread.
        $this->post($thread->path() . '/subcriptions');

        $this->assertCount(1, $thread->subcriptions);

    }
}

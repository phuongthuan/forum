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

        $thread = create(Thread::class);

        $this->post($thread->path() . '/subcriptions');

        $this->assertCount(1, $thread->fresh()->subcriptions);

    }

    /** @test */
    public function a_user_can_unsubcribe_from_threads()
    {

        $this->signIn();

        $thread = create(Thread::class);

        $thread->subcribe();

        $this->delete($thread->path() . '/subcriptions');

        $this->assertCount(0, $thread->subcriptions);
    }
}

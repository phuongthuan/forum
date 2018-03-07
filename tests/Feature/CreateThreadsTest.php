<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Thread;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_may_not_create_a_thread()
    {
        $this->withExceptionHandling();
        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_create_a_thread()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

}

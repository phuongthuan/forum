<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function unauthenticated_users_may_not_add_replies()
    {
        $this->withExceptionHandling()
            ->post('/threads/thuan/1/replies', [])
            ->assertRedirect('/login');
    }

    /** @test */
    function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->be($user = create(User::class));
        $thread = create(Thread::class);
        $reply = create(Reply::class);
        $this->post($thread->path() . '/replies', $reply->toArray());
        $this->get($thread->path())->assertSee($reply->body);
    }
}

<?php

namespace Tests\Unit;

use App\Notifications\ThreadWasUpdated;
use App\Thread;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    protected $thread;

    public function setUp()
    {
        parent::setUp();
       $this->thread = factory(Thread::class)->create();

    }
    /** @test */
    public function a_thread_has_replies()
    {
        $this->assertInstanceOf(Collection::class, $this->thread->replies);
    }
    
    /** @test */
    public function a_thread_has_creator()
    {
        $this->assertInstanceOf(User::class, $this->thread->creator);
    }
    
    /** @test */
    public function a_thread_can_make_a_string_path()
    {
        $thread = create(Thread::class);
        $this->assertEquals("/threads/{$thread->channel->slug}/{$thread->id}", $thread->path());
    }
    
    /** @test */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'FooBar',
            'user_id' => 1,
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
    
    /** @test */
    public function a_thread_belongs_to_a_channel()
    {
        $thread = create(Thread::class);
        $this->assertInstanceOf('App\Channel', $thread->channel);

    }
    
    /** @test */
    public function a_thread_can_be_subcribed_to()
    {
        $thread = create(Thread::class);

        $this->signIn();

        $thread->subcribe();

        $this->assertEquals(1,
            $thread->subcriptions()->where('user_id', auth()->id())->count()
        );
    }

    /** @test */
    public function a_thread_notify_all_subcribers_when_reply_was_added()
    {
        Notification::fake();

        $this->signIn()
            ->thread
            ->subcribe()
            ->addReply([
                'body' => 'FooBar',
                'user_id' => 1,
            ]);

        Notification::assertSentTo(auth()->user(), ThreadWasUpdated::class);
    }

    /** @test */
    public function a_thread_can_be_unsubcribed()
    {
        $thread = create(Thread::class);

        $userId = 1;

        $thread->subcribe($userId);

        $thread->unsubcribe($userId);

        $this->assertCount(0, $thread->subcriptions);
    }
    
    /** @test */
    public function a_thread_can_check_all_authenticated_users_read_all_replies()
    {
        $this->signIn();

        $thread = create(Thread::class);

        tap(auth()->user(), function ($user) use ($thread) {
            $this->assertTrue($thread->hasUpdatesFor(auth()->user()));
            $user->read($thread);
            $this->assertFalse($thread->hasUpdatesFor(auth()->user()));
        });
    }
}

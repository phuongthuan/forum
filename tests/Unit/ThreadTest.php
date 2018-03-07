<?php

namespace Tests\Unit;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
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











}

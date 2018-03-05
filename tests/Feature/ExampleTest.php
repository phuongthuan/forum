<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;
    public $thread;

    public function setUp()
    {
        parent::setUp();
        $this->thread = factory(Thread::class)->create();

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->get('/')
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_browse_thread()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_view_a_single_thread()
    {
        $this->get('/threads/' . $this->thread->id)
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_replies_the_associated_with_a_thread()
    {

        //And that thread includes replies
        $reply = factory(Reply::class)->create([
            'thread_id' => $this->thread->id,
        ]);

        //When we visit a thread page
        $this->get('/threads/' . $this->thread->id)
            ->assertSee($reply->body);
    }




























}

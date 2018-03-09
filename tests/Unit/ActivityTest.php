<?php

namespace Tests\Unit;

use App\Activity;
use App\Reply;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_records_display_in_DB_when_create_a_thread()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->assertDatabaseHas('activities', [
            'type' => 'created_thread',
            'user_id' => auth()->id(),
            'subjectable_id' => $thread->id,
            'subjectable_type' => 'App\Thread',
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subjectable->id, $thread->id);
    }
    
    /** @test */
    public function it_records_display_in_DB_when_user_do_replies_action()
    {
        $this->signIn();

        $reply = create(Reply::class);

        $this->assertEquals(2, Activity::count());
    }
}

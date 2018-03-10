<?php

namespace Tests\Unit;

use App\Activity;
use App\Reply;
use App\Thread;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
    
    /** @test */
    public function it_can_fetches_a_feed_for_any_user()
    {
        $this->signIn();

        create(Thread::class, ['user_id' => auth()->id()], 2);

        auth()->user()->activities()->first()->update(['created_at' => Carbon::now()->subWeek()]);

        //When we fetch their feed.
        $feed = Activity::feed(auth()->user());

        //Then it should be retunred in the proper format.
        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
        ));

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->subWeek()->format('Y-m-d')
        ));

    }
}

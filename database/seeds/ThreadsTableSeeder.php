<?php

use App\Reply;
use Illuminate\Database\Seeder;
use App\Thread;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $threads = factory(Thread::class, 10)->create();
        $threads->each(function ($thread) {
           factory(Reply::class, 5)->create(['thread_id' => $thread->id]);
        });
    }
}

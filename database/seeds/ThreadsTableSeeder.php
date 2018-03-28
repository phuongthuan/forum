<?php

use App\Reply;
use App\User;
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
        $user = factory(User::class)->create([
            'name' => 'Carl',
            'email' => 'carl95@example.com',
            'password' => bcrypt('123123'),
        ]);

        $threads = factory(Thread::class, 10)->create();

        $threads->each(function ($thread) {
           factory(Reply::class, 40)->create(['thread_id' => $thread->id]);
        });

        factory(Thread::class, 5)->create([
            'user_id' => $user->id
        ]);
    }
}

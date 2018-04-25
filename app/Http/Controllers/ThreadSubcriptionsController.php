<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ThreadSubcriptionsController extends Controller
{

    /**
     * User subcribe to thread.
     *
     * @param $channelId
     * @param Thread $thread
     */
    public function store($channelId, Thread $thread)
    {
        $thread->subcribe();
    }

    /**
     * User unsubcribe from thread.
     *
     * @param $channelId
     * @param Thread $thread
     */
    public function destroy($channelId, Thread $thread)
    {
        $thread->unsubcribe();
    }
}

<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ThreadSubcriptionsController extends Controller
{
    public function store($channelId, Thread $thread)
    {
        $thread->subcribe(1);
    }
}

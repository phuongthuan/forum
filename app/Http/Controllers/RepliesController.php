<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\RedirectResponse;

class RepliesController extends Controller
{
    /**
     * Create a new RepliesController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Thread $thread
     * @return RedirectResponse
     */
    public function store(Thread $thread)
    {
        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

        return back();
    }
}

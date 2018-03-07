<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ThreadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Channel $channel
     * @return Response
     */
    public function index(Channel $channel)
    {
        if ($channel->exists) {
            $threads = $channel->threads()->latest();
        } else {
            $threads = Thread::latest();
        }

        // if request('by'), we should filter by given username.
        if ($username = request('by')) {
            $user = User::where('name', $username)->firstOrFail();
            $threads = Thread::where('user_id', $user->id);
        }

        $threads = $threads->get();

        return view('threads.index', compact('threads'));
    }

    /**
     * Create a specify resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('threads.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id',
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body'),
        ]);

        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param $channelId
     * @param  Thread $thread
     * @return Response
     */
    public function show($channelId, Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  Thread $thread
     * @return Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Thread $thread
     * @return Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}

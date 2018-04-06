<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Database\Eloquent\Model;

class FavoritesController extends Controller
{
    /**
     * FavoritesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @param Reply $reply
     * @return Model
     */
    public function store(Reply $reply)
    {
        $reply->favorite();
        return back();
    }

    /**
     * Unfavorite a reply.
     *
     * @param Reply $reply
     */
    public function destroy(Reply $reply)
    {
        $reply->unfavorite();
    }
}

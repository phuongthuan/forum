<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Reply;
use DB;
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

}

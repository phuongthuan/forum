<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ProfilesController extends Controller
{
    /**
     * @param User $user
     * @return Factory|View
     */
    public function show(User $user)
    {
        return view('profiles.show', [
            'profileUser' => $user,
            'threads' => $user->threads()->paginate(20),
        ]);
    }
}

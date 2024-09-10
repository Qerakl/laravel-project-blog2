<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow($id)
    {
        Follow::create([
            'follower_id' => Auth::id(),
            'followed_id' => $id,
        ]);

        return redirect()->back()->with('success', 'Вы подписались на пользователя.');
    }
}

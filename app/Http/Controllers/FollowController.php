<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    private $follow;
    private $notification;

    public function __construct(Follow $follow, Notification $notification,) {
        $this->follow = $follow;
        $this->notification = $notification;
    }

    public function store($user_id) {
        $this->follow->follower_id = Auth::user()->id;
        $this->follow->following_id = $user_id;
        $this->follow->save();

        // create notification
        $this->notification->user_id = $user_id;
        $this->notification->message = Auth::user()->name . ' followed you.';
        $this->notification->link = route('profile.followers', $user_id);
        $this->notification->save();

        return redirect()->back();
    }

    public function destroy($user_id) {
        $this->follow
            ->where('follower_id', Auth::user()->id)
            ->where('following_id', $user_id)
            ->delete();

        return redirect()->back();
    }
}

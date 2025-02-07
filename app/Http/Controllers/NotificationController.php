<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    private $notification;
    private $user;

    public function __construct(Notification $notification, User $user) {
        $this->notification = $notification;
        $this->user = $user;
    }

    public function index() {
        $user = $this->user->findOrfail(Auth::user()->id);
        $notifications = $user->notifications()->paginate(10);
        
        return view('profile.notifications', compact('notifications'));
    }

    public function readAll() {
        $notifications = $this->notification
            ->where('user_id', Auth::user()->id)
            ->get();

        foreach($notifications as $notification) {
            $notification->unread = false;
            $notification->save();
        }

        return redirect()->back();
    }

    public function read($id) {
        $notification = $this->notification->findOrFail($id);
        $notification->unread = false;
        $notification->save();

        if($notification->link) {
            return redirect($notification->link);
        } else {
            return redirect()->back();
        }
    }
}

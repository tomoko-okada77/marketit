<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function show($id) {
        $user = $this->user->findOrfail($id);

        return view('profile.show')
                ->with('user', $user);
    }

    public function edit($id) {
        $user = $this->user->findOrfail($id);

        return view('profile.edit')
                ->with('user', $user);
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:50|unique:users,email,' . Auth::user()->id,
            'avatar' => 'mimes:jpg,jpeg,gif,png|max:1048',
            'introduction' => 'max:100',
        ]);

        $user = $this->user->findOrfail(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->introduction = $request->introduction;

        if($request->avatar) {
            $user->avatar = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
        }

        $user->save();

        return redirect()->route('profile.show', Auth::user()->id);
    }

    public function followers($id) {
        $user = $this->user->findOrfail($id);

        return view('profile.followers')
                ->with('user', $user);
    }

    public function following($id) {
        $user = $this->user->findOrfail($id);
        $suggested_users = $this->getSuggestedUsers();

        return view('profile.following')
                ->with('user', $user)
                ->with('suggested_users', $suggested_users);
    }

    private function getSuggestedUsers() {
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach($all_users as $user) {
            if(!$user->isFollowed()) {
                $suggested_users[] = $user;
            }
        }

        return $suggested_users;
    }

    public function favorite($id) {
        $user = $this->user->findOrfail($id);

        return view('profile.favorite')
                ->with('user', $user);
    }

    public function purchases($id) {
        $user = $this->user->findOrfail($id);

        return view('profile.purchases')
                ->with('user', $user);
    }

    public function sales($id) {
        $user = $this->user->findOrfail($id);

        return view('profile.sales')
                ->with('user', $user);
    }

    // public function notifications($id) {
    //     $user = $this->user->findOrfail($id);

    //     return view('profile.notifications')
    //             ->with('user', $user);
    // }

    public function reviews($id) {
        $user = $this->user->findOrfail($id);

        return view('profile.reviews')
                ->with('user', $user);
    }
}

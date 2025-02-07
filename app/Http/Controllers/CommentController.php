<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment) {
        $this->comment = $comment;
    }

    public function store(Request $request, $product_id) {
        $request->validate(
            [
                'body' => 'required|max:150'
            ],
            [
                'body' . '.required' => 'You cannot submit an empty comment.',
                'body' . '.max' => 'The comment must not have more than 150 characters.',
            ]
        );

        $this->comment->body = $request->input('body');
        $this->comment->user_id = Auth::user()->id;
        $this->comment->product_id = $product_id;
        $this->comment->save();

        return redirect()->back();
    }

    public function destroy($id) {
        $this->comment->destroy($id);

        return redirect()->back();
    }
}

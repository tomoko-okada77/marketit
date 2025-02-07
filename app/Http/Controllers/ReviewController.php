<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    private $review;
    private $product;
    private $notification;

    public function __construct(Review $review, Product $product, Notification $notification) {
        $this->review = $review;
        $this->product = $product;
        $this->notification = $notification;
    }

    public function store(Request $request, $product_id) {
        $request->validate([
            'score' => 'required|integer|between:1,5',
            'comment' => 'required|min:1|max:1000'
        ]);

        $product = $this->product->findOrFail($product_id);

        $this->review->user_id = $product->user_id;
        $this->review->product_id = $product->id;
        $this->review->reviewer_id = Auth::user()->id;
        $this->review->score = $request->score;
        $this->review->comment = $request->comment;
        $this->review->save();

        // create notification
        $this->notification->user_id = $product->user_id;
        $this->notification->message = Auth::user()->name . ' reviewed your product.';
        $this->notification->link = route('product.show', $product_id);
        $this->notification->save();

        return redirect()->back();
    }
}

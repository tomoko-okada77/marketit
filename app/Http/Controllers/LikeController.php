<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    private $like;
    private $notification;
    private $product;

    public function __construct(Like $like, Notification $notification, Product $product) {
        $this->like = $like;
        $this->notification = $notification;
        $this->product = $product;
    }

    public function store($product_id) {
        $this->like->user_id = Auth::user()->id;
        $this->like->product_id = $product_id;
        $this->like->save();

        $product = $this->product->findOrFail($product_id);

        // create notification
        if($product->user_id != Auth::user()->id) {
            $this->notification->user_id = $product->user_id;
            $this->notification->message = Auth::user()->name . ' liked your product.';
            $this->notification->link = route('product.show', $product_id);
            $this->notification->save();
        }
        
        return redirect()->back();
    }

    public function destroy($product_id) {
        $this->like
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $product_id)
            ->delete();

        return redirect()->back();
    }
}

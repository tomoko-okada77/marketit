<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    private $transaction;
    private $product;
    private $notification;

    public function __construct(Transaction $transaction, Product $product, Notification $notification) {
        $this->transaction = $transaction;
        $this->product = $product;
        $this->notification = $notification;
    }

    public function store($product_id) {

        // create transaction
        $this->transaction->buyer_id = Auth::user()->id;
        $this->transaction->product_id = $product_id;

        $product = $this->product->findOrFail($product_id);
        $this->transaction->seller_id = $product->user_id;

        $this->transaction->save();

        // create notification
        $this->notification->user_id = $product->user_id;
        $this->notification->message = Auth::user()->name . ' bought your product.';
        $this->notification->link = route('profile.sales', $product->user_id);
        $this->notification->save();
        
        return redirect()->route('product.show', $product_id);
    }
}

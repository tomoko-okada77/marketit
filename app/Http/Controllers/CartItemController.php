<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Transaction;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    private $cart_item;
    private $user;
    private $product;
    private $transaction;
    private $notification;

    public function __construct(CartItem $cart_item, User $user, Product $product, Transaction $transaction, Notification $notification) {
        $this->cart_item = $cart_item;
        $this->user = $user;
        $this->product = $product;
        $this->transaction = $transaction;
        $this->notification = $notification;
    }

    public function index() {
        $user = $this->user->findOrfail(Auth::user()->id);
        $cart_items = $user->cartItems;

        return view('profile.cart', compact('cart_items'));
    }

    public function store($product_id) {
        $this->cart_item->user_id = Auth::user()->id;
        $this->cart_item->product_id = $product_id;
        $this->cart_item->save();

        return redirect()->back();
    }

    public function buy() {
        $cart_items = $this->cart_item->where('user_id', Auth::user()->id)->get();
        $transactions = [];
        
        foreach($cart_items as $item) {

            // $this->transaction->buyer_id = Auth::user()->id;
            // $this->transaction->product_id = $item->product_id;

            $product = $this->product->findOrFail($item->product_id);
            // $this->transaction->seller_id = $product->user_id;

            $transactions[] = [
                'buyer_id' => $item->user_id,
                'seller_id' => $product->user_id,
                'product_id' => $item->product_id,
                'created_at' => now(),
                'updated_at' => now()
            ];

            // $this->transaction->save();

            // create notification
            $this->notification->user_id = $product->user_id;
            $this->notification->message = Auth::user()->name . ' bought your product.';
            $this->notification->link = route('profile.sales', $product->user_id);
            $this->notification->save();
            
        }

        // print_r($transactions);

        // $this->transaction->createMany($transactions);
        Transaction::insert($transactions);
        $this->cart_item->where('user_id', Auth::user()->id)->delete();

        return redirect()->route('profile.purchases', ['id' => Auth::user()->id]);
    }

    public function destroy($product_id) {
        $cart_item = $this->cart_item->where('product_id', $product_id)->where('user_id', Auth::id())->first();

        if ($cart_item) {
            $cart_item->delete();
        }

        return redirect()->back();
    }
}

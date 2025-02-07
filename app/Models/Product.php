<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function productCategories() {
        return $this->hasMany(CategoryProduct::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function isLiked() {
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }

    public function comments() {
        return $this->hasMany(Comment::class)->latest();
    }

    public function transaction() {
        return $this->hasOne(Transaction::class);
    }

    public function review() {
        return $this->hasOne(Review::class);
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }
}

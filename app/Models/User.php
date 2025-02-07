<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function products() {
        return $this->hasMany(Product::class)->latest();
    }

    public function followers() {
        return $this->hasMany(Follow::class, 'following_id');
    }

    public function following() {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function isFollowed() {
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
    }

    public function favorites() {
        return $this->hasMany(Like::class);
    }

    public function purchases() {
        return $this->hasMany(Transaction::class, 'buyer_id')->latest();
    }

    public function sales() {
        return $this->hasMany(Transaction::class, 'seller_id')->latest();
    }

    public function notifications() {
        return $this->hasMany(Notification::class)->latest();
    }

    public function unreadNotifications() {
        return $this->notifications()->where('unread', 1);
    }

    public function reviews() {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function averageScore() {
        return round($this->reviews()->avg('score'));
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class, 'user_id');
    }
}

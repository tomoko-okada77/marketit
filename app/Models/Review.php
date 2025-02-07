<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function reviewer() {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $timestamps = false;

    public function product() {
        return $this->belongsTo(Product::class);
    }
}

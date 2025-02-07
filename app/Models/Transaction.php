<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  protected $fillable = ['buyer_id', 'product_id', 'seller_id'];

  public function product() {
    return $this->belongsTo(Product::class);
  }
}

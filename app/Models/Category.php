<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function categoryProducts() {
        return $this->hasMany(CategoryProduct::class, 'category_id');
    }
}

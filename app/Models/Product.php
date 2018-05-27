<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function lineItems()
    {
        return $this->hasMany('App\Models\LineItem', 'product_id');
    }
}

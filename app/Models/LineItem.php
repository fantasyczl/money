<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineItem extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}

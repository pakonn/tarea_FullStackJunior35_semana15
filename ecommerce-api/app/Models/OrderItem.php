<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'cantidad',
        'product_id',
        'order_id'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'nombre_cliente',
        'direccion_cliente',
        'telefono_cliente',
        'email_cliente',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function OrdersItem(){
        return $this->hasMany(OrderItem::class);
    }        
}

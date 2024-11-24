<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'note',
        'payment_method',
        'total',
        'status_order_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    
    }
    public function statusOrder(){
        return $this->belongsTo(StatusOrder::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function detailOrders(){
        return $this->hasMany(DetailOrder::class);
    }
}

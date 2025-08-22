<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'subtotal', 'grand_total', 'shipping', 'discount', 'coupon_code', 'coupon_code_id',
        'payment_status', 'status', 'user_id', 'first_name', 'last_name', 'mobile',
        'email', 'country_id', 'address', 'city', 'state', 'zip', 'apartment', 'notes'
    ];
   

    public function items(){
        return $this->hasMany(OrderItem::class);
    }
}

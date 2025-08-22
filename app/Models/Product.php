<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function product_images(){
        return $this->hasMany(ProductImages::class);
    }

    protected $fillable = [
        'title',
       ' slug',
       'description',
       'short_description',
       'shipping_returns',
       'related_products',
       '  price',
       ' compare_price',
       ' category_id',
       ' subcategory_id',
       ' brand_id',
       ' sku',
       ' barcode',
        'track_qty',
      '  qty',
       ' status',
       
    ];

public function product_ratings(){

    return $this->hasMany(ProductRatings::class)->where('status',1);

}
   
}

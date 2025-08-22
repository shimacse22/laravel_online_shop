<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'slug',
        'barcode',
        'sku',
        'category_id',
        'subcategory_id'
    ];
}

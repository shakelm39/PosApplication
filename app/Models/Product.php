<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'unit_id',
        'category_id',
        'brand_id',
        'name',
        'quantity',
        'status',
        'created_by',
        'updated_by'
    ];

    public function supplier(){

    	return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    public function brand(){

    	return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function category(){

    	return $this->belongsTo(Category::class,'category_id','id');
    }
    public function unit(){

    	return $this->belongsTo(Unit::class,'unit_id','id');
    }
}

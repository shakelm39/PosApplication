<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'invoice_id',
        'category_id',
        'brand_id',
        'product_id',
        'selling_qty',
        'unit_price',
        'selling_price'
    ];
}

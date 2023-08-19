<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable =[
        'invoice_id',
        'customer_id',
        'paid_status',
        'paid_amount',
        'due_amount',
        'total_amount',
        'discount_amount'
    ];
}

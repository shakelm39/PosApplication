<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
    use HasFactory;
    protected $fillable  =[
        'invoice_id',
        'current_paid_amount',
        'date',
        'updated_by'
    ];
}

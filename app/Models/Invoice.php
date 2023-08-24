<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_no',
        'date',
        'description',
        'status',
        'created_by',
        'approved_by'
    ];

    public function payment(){

    	return $this->belongsTo(Payment::class,'id','invoice_id');
    } 
    public function invoice_details(){

    	return $this->hasMany(invoiceDetails::class,'invoice_id','id');
    }
}

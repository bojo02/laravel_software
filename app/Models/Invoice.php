<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'price', 'order_id', 'payment_id', 'user_id'];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

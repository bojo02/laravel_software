<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'order_id', 'path', 'type'];

    public function order(){
        $this->belongsTo(Order::class);
    }
    public function user(){
        $this->belongsTo(User::class);
    }
}

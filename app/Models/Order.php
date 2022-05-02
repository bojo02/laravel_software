<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['name','design','address','object','product','vision','media','size','number','pockets','eyelets',
    'area','laminat','term','install_description','preprint_description' , 'role_id','user_id', 'price',
     'title', 'description', 'name', 'format_id', 'phone', 'photo', 'email'];

    public function viewstatus(){
        return $this->belongsTo(Statuses::class, 'status_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function format(){
        return $this->belongsTo(Format::class);
    }
    public function notes(){
        return $this->hasMany(Note::class, 'order_id');
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }
}


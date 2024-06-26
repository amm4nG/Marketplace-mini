<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInstrument extends Model
{
    use HasFactory;
    protected $table = 'order_instruments';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detailOrder(){
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function payment(){
        return $this->hasOne(Payment::class, 'order_id');
    }
}

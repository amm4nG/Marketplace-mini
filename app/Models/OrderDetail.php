<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $guarded = ['id'];

    public function instrument(){
        return $this->belongsTo(Instrument::class, 'instrument_id');
    }
}

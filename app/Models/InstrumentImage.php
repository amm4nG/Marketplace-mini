<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstrumentImage extends Model
{
    use HasFactory;
    protected $table = 'instrument_images';
    protected $guarded = ['id'];
}

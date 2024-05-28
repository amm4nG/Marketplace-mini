<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Instrument;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function index(){
        $instruments = Instrument::all();
        return view('buyer.instruments.index', compact('instruments'));
    }
}

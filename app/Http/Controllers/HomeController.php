<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $slides = Slide::all();
        $instruments = Instrument::paginate(6); 
        return view('welcome', compact('slides', 'instruments'));
    }
}

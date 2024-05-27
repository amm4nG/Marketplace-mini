<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $slides = Slide::all();
        return view('welcome', compact('slides'));
    }
}

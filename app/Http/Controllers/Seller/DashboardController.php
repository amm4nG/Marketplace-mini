<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Instrument;
use App\Models\OrderInstrument;
use App\Models\Slide;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuyer = User::where('role', 'buyer')->count();
        $totalSeller = User::where('role', 'seller')->count();
        $totalInstrument = Instrument::count();
        $totalCategory = Category::count();
        $totalOrder = OrderInstrument::count();
        $totalSlideShow = Slide::count();
        return view('seller.dashboard', compact(['totalBuyer', 'totalSeller', 'totalInstrument', 'totalCategory', 'totalOrder', 'totalSlideShow']));
    }
}

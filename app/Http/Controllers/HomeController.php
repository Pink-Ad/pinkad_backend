<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check()) {
            $from = now()->startOfMonth(); // first date of the current month
            $to = now();
            $visitor = Customer::count();
            $seller = Seller::count();
            $monthly_user_count = User::whereBetween('created_at', [$from, $to])->count();
            return view('admin.pages.home',compact('visitor','seller','monthly_user_count'));
        } else {
            return redirect()->route('login');
        }
    }
}

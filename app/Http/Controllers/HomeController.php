<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\PerangkatDaerah;
use App\User;
use Auth;

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
        if((int) Auth::user()->level == 1){
            return view('pages.home.admin');
        }
        else if((int) Auth::user()->level == 2){
            return view('pages.home.customer');
        }
        else if((int) Auth::user()->level == 3){
            return view('pages.home.agen');
        }
        else if((int) Auth::user()->level == 4){
            return view('pages.home.kurir');
        }
    }

    
}

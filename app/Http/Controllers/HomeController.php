<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use App\Tower;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $towers = Tower::all();

        return view('home',['towers'=>$towers]);
    }
}

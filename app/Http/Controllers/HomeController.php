<?php

namespace App\Http\Controllers;

use Auth;
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
        if(Auth::user()->type == "Consortium"){
            return view('user_consortium.index');    
        }else if(Auth::user()->type == "Secretariat"){
            return view('user_secretariat.index');
        }else if(Auth::user()->type == "Researcher"){
            return view('user_researcher.index');
        }else{
            return view('user_admin.index');
        }
    }
}

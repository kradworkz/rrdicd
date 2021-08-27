<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function verify(){
        return view('user_common.verify');
    }
}

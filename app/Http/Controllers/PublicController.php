<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function verify(){
        return \Storage::download('public/uploads/DOST_OSEC_BAR_1_as_of_4th_Quarter_2020.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Research;
use App\Models\Researcher;
use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function total(){
        $counts[] = [  
            $data[] = [
                'name' => 'Total Research',
                'count' => Research::count(),
                'color' => 'primary',
                'icon' => 'bxs-book'
            ],
            $data[]  = [
                'name' => 'Total Researcher',
                'count' => Researcher::count(),
                'color' => 'success',
                'icon' => 'bxs-user-circle'
            ],
            $data[] = [
                'name' => 'Total Events',
                'count' => Event::count(),
                'color' => 'danger',
                'icon' => 'bxs-calendar'
            ],
        ];

        return $counts;
    }
}

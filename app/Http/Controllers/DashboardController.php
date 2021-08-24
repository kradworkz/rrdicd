<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\Research;
use App\Models\Researcher;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventResource;
use App\Models\File;
use App\Http\Resources\FileResource;
use App\Models\Dropdown;
use App\Http\Resources\DropdownResource;
use App\Http\Resources\ResearchResource;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function total(){
        $counts[] = [  
            $data[] = [
                'name' => 'Total Research',
                'count' => Research::count(),
                'color' => 'primary',
                'female' => 'n/a',
                'male' => 'n/a',
                'icon' => 'bxs-book'
            ],
            $data[]  = [
                'name' => 'Total Researcher',
                'count' => Researcher::count(),
                'female' => Researcher::whereHas('user',function ($query) {
                    $query->whereHas('profile',function ($query) {
                        $query->where('gender','Female');
                    });
                })->count(),
                'male' => Researcher::whereHas('user',function ($query) {
                    $query->whereHas('profile',function ($query) {
                        $query->where('gender','Male');
                    });
                })->count(),
                'color' => 'success',
                'icon' => 'bxs-user-circle'
            ],
            $data[] = [
                'name' => 'Total Events',
                'count' => Event::count(),
                'color' => 'danger',
                'female' => 'n/a',
                'male' => 'n/a',
                'icon' => 'bxs-calendar'
            ],
        ];

        return $counts;
    }

    public function side(){

        $event = Event::first();
        $event = new EventResource($event);

        $file = File::first();
        $file = new FileResource($file);

        $events = Dropdown::where('classification','Events')->get();
        $events = DropdownResource::collection($events);

        $research =  Research::with('statuses:status_id,research_id','statuses.status:id,name,color')->with('iprstatus')
        ->with('classification')->with('user:id','user.profile:firstname,lastname,user_id')->with('info')
        ->first();

        // $research = new ResearchResource($research);

        $counts[] = [  
            $data[] = $event,
            $data[] = $file,
            $data[] = $events,
            $data[] = $research
        ];

        return $counts;
    }

    public function ages(){
        $user = UserProfile::whereHas('user',function ($query) {
            $query->where('type','Researcher');
        })->count();

        $counts[] = [  
            $data[] = [
                'name' => 'Below 20 years old',
                'count' => $c = UserProfile::agedBetween(0, 20),
                'percentage' => ($c / $user) * 100,
                'color' => 'primary',
            ],
            $data[]  = [
                'name' => '20-30 years old',
                'count' => $c = UserProfile::agedBetween(20, 30),
                'percentage' => ($c / $user) * 100,
                'color' => 'success',
            ],
            $data[] = [
                'name' => '31-40 years old',
                'count' => $c = UserProfile::agedBetween(31, 40),
                'percentage' => ($c / $user) * 100,
                'color' => 'danger',
            ],
            $data[] = [
                'name' => '41-50 years old',
                'count' => $c = UserProfile::agedBetween(41, 50),
                'percentage' => ($c / $user) * 100,
                'color' => 'danger',
            ],
            $data[] = [
                'name' => '51-60 years old',
                'count' => $c = UserProfile::agedBetween(51, 60),
                'percentage' => ($c / $user) * 100,
                'color' => 'danger',
            ],
            $data[] = [
                'name' => 'Above 60 years old',
                'count' => $c = UserProfile::agedBetween(61, 100),
                'percentage' => ($c / $user) * 100,
                'color' => 'danger',
            ],
        ];

        return $counts;

        
    }


}

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

        $organization_id = (!empty(\Auth::user()->organization->organization_id)) ? \Auth::user()->organization->organization_id : 0;

        $query = Research::query();
        if($organization_id != 0){
            $query->whereHas('user',function ($query) use ($organization_id){
                $query->whereHas('researcher',function ($query) use ($organization_id){
                    $query->where('institution_id', $organization_id);
                });
            });
        }
        $research = $query->count();

        $query = Researcher::query();
        $query->select('user_id')->with('user:id','user.profile:user_id,gender');
        ($organization_id != 0) ? $query->where('institution_id',$organization_id) : '';
        $researchers = $query->get()->toArray();

        $counts[] = [  
            $data[] = [
                'name' => 'Total Research',
                'count' => $research,
                'color' => 'primary',
                'female' => 'n/a',
                'male' => 'n/a',
                'icon' => 'bxs-book'
            ],
            $data[]  = [
                'name' => 'Total Researcher',
                'count' => count($researchers),
                'female' => count(array_filter($researchers,function($element) {return $element['user']['profile']['gender']=='Female';})),
                'male' => count(array_filter($researchers,function($element) {return $element['user']['profile']['gender']=='Male';})),
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

        (!empty($event = Event::first()) > 0) ? $event = new EventResource($event) : $event = [];
        (!empty($file = File::first()) > 0) ? $file = new FileResource($file) : $file = [];

        $events = Dropdown::where('classification','Events')->get();
        $events = DropdownResource::collection($events);

        $organization_id = (!empty(\Auth::user()->organization->organization_id)) ? \Auth::user()->organization->organization_id : 0;

        $query =  Research::query();
        $query->with('statuses:status_id,research_id','statuses.status:id,name,color')->with('iprstatus')
        ->with('classification')->with('user:id','user.profile:firstname,lastname,user_id')->with('info');

        if($organization_id != 0){
            $query->whereHas('user',function ($query) use ($organization_id){
                $query->whereHas('researcher',function ($query) use ($organization_id){
                    $query->where('institution_id', $organization_id);
                });
            });
        }
        $research = $query->first();
        
        $query = Researcher::query();
        $query->select('user_id')->with('user:id','user.profile');
        ($organization_id != 0) ? $query->where('institution_id',$organization_id) : '';
        $researcher = $query->first();


        $counts[] = [  
            $data[] = $event,
            $data[] = $file,
            $data[] = $events,
            $data[] = $research,
            $data[] = $researcher
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
                'percentage' => ($c != 0) ? ($c / $user) * 100 : 0,
                'color' => 'primary',
            ],
            $data[]  = [
                'name' => '20-30 years old',
                'count' => $c = UserProfile::agedBetween(20, 30),
                'percentage' => ($c != 0) ? ($c / $user) * 100 : 0,
                'color' => 'success',
            ],
            $data[] = [
                'name' => '31-40 years old',
                'count' => $c = UserProfile::agedBetween(31, 40),
                'percentage' => ($c != 0) ? ($c / $user) * 100 : 0,
                'color' => 'danger',
            ],
            $data[] = [
                'name' => '41-50 years old',
                'count' => $c = UserProfile::agedBetween(41, 50),
                'percentage' => ($c != 0) ? ($c / $user) * 100 : 0,
                'color' => 'danger',
            ],
            $data[] = [
                'name' => '51-60 years old',
                'count' => $c = UserProfile::agedBetween(51, 60),
                'percentage' => ($c != 0) ? ($c / $user) * 100 : 0,
                'color' => 'danger',
            ],
            $data[] = [
                'name' => 'Above 60 years old',
                'count' => $c = UserProfile::agedBetween(61, 100),
                'percentage' => ($c != 0) ? ($c / $user) * 100 : 0,
                'color' => 'danger',
            ],
        ];
        return $counts;
    }

    public function gender(){
        $counts = [  
            $data[] = [
                'name' => 'Female',
                'count' =>  Researcher::whereHas('user',function ($query) {
                    $query->whereHas('profile',function ($query) {
                        $query->where('gender','Female');
                    });
                })->count(),
                'color' => 'danger',
                'icon' => 'bx-female'
            ],
            $data[] = [
                'name' => 'Male',
                'count' =>  Researcher::whereHas('user',function ($query) {
                    $query->whereHas('profile',function ($query) {
                        $query->where('gender','Male');
                    });
                })->count(),
                'color' => 'info',
                'icon' => 'bx-male'
            ],
        ];

        return $counts;
    }
}

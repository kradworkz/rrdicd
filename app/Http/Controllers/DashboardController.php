<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\UserProfile;
use App\Models\Research;
use App\Models\ResearcherEducation;
use App\Models\Researcher;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventResource;
use App\Models\File;
use App\Http\Resources\FileResource;
use App\Models\Dropdown;
use App\Http\Resources\DropdownResource;
use App\Http\Resources\ResearchResource;
use App\Http\Resources\InstitutionResource;
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

    public function ages($val){
        if($val == '-'){
            $id = '';
        }else{
            $id = explode("*", $val);
            $id = ($id[0] == '-') ? $id = '': $id = $id[0] ;
        }

        if(Auth::user()->type == "Secretariat"){
            $id = Auth::user()->organization->organization_id;
        }

        $user = UserProfile::whereHas('user',function ($query) use ($id) {
            $query->where('type','Researcher');
            $query->whereHas('researcher',function ($query) use ($id){
               ($id != '') ? $query->where('institution_id',$id) : '';
            });
        })->count();

        $counts[] = [  
            $data[] = [
                'name' => 'Below 20 years old',
                'count' => $c = UserProfile::agedBetween(0, 20, $id),
                'percentage' => ($c != 0 && $user != 0) ? ($c / $user) * 100 : 0,
                'color' => 'primary',
            ],
            $data[]  = [
                'name' => '20-30 years old',
                'count' => $c = UserProfile::agedBetween(20, 30,$id),
                'percentage' => ($c != 0 && $user != 0) ? ($c / $user) * 100 : 0,
                'color' => 'success',
            ],
            $data[] = [
                'name' => '31-40 years old',
                'count' => $c = UserProfile::agedBetween(31, 40,$id),
                'percentage' => ($c != 0 && $user != 0) ? ($c / $user) * 100 : 0,
                'color' => 'danger',
            ],
            $data[] = [
                'name' => '41-50 years old',
                'count' => $c = UserProfile::agedBetween(41, 50,$id),
                'percentage' => ($c != 0 && $user != 0) ? ($c / $user) * 100 : 0,
                'color' => 'danger',
            ],
            $data[] = [
                'name' => '51-60 years old',
                'count' => $c = UserProfile::agedBetween(51, 60,$id),
                'percentage' => ($c != 0 && $user != 0) ? ($c / $user) * 100 : 0,
                'color' => 'danger',
            ],
            $data[] = [
                'name' => 'Above 60 years old',
                'count' => $c = UserProfile::agedBetween(61, 100,$id),
                'percentage' => ($c != 0 && $user != 0) ? ($c / $user) * 100 : 0,
                'color' => 'danger',
            ],
        ];
        return $counts;
    }

    public function gender($val){
        if($val == '-'){
            $id = '';
        }else{
            $id = explode("*", $val);
            $id = ($id[0] == '-') ? $id = '': $id = $id[0] ;
        }

        if(Auth::user()->type == "Secretariat"){
            $id = Auth::user()->organization->organization_id;
        }

        $counts = [  
            $data[] = [
                'name' => 'Female',
                'count' =>  Researcher::Gender('Female',$id),
                'color' => 'danger',
                'icon' => 'bx-female'
            ],
            $data[] = [
                'name' => 'Male',
                'count' =>  Researcher::Gender('Male',$id),
                'color' => 'info',
                'icon' => 'bx-male'
            ],
        ];

        return $counts;
    }

    public function institution(){
       $data = Organization::select('id','name')->withCount('researchers')->with('researchers:id,institution_id,user_id','researchers.user:id')->where('type_id',3)->get();
       return  InstitutionResource::collection($data);

    }

    public function dropdowns($type,$val){
        if($val == '-'){
            $id = '';
        }else{
            $id = explode("*", $val);
            $id = ($id[0] == '-') ? $id = '': $id = $id[0] ;
        }

        if(Auth::user()->type == "Secretariat"){
            $id = Auth::user()->organization->organization_id;
        }

        $query = Dropdown::query(); 
        ($type == "Status") ? $query->where('type','Research Status') : '';
        $dropdowns = $query->where('classification',$type)->get();
        $counts = [];

        foreach($dropdowns as $dropdown){
            if($type == "Specialties"){
                $query = Researcher::query();
                ($id != '') ? $query->where('institution_id',$id)->count() : '';
                $count = $query->where('specialty_id',$dropdown->id)->count();
            }else if($type == "Qualifications"){
                $count = ResearcherEducation::where('qualification_id',$dropdown->id) 
                ->whereHas('researcher',function ($query) use ($id){
                    ($id != '') ? $query->where('institution_id',$id) : '';
                })->count();
            }else if($type == "Status"){
                $query = Research::query();
                $query->where('status_id',$dropdown->id);
                $query->whereHas('user',function ($query) use ($id){
                    $query->whereHas('researcher',function ($query) use ($id){
                        ($id != '') ? $query->where('institution_id', $id) : '';
                    });
                });
                $count = $query->count();
            }else{
                $query = Research::query();
                $query->where('classification_id',$dropdown->id);
                $query->whereHas('user',function ($query) use ($id){
                    $query->whereHas('researcher',function ($query) use ($id){
                        ($id != '') ? $query->where('institution_id', $id) : '';
                    });
                });
                $count = $query->count();
            }
           
            $data = [
                'name' => $dropdown->name,
                'count' =>  $count
            ];
            array_push($counts,$data);
        }
        return $counts;
    }
}

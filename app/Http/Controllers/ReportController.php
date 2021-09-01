<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Research;
use App\Models\UserProfile;
use App\Models\Researcher;
use App\Models\ResearcherEducation;
use App\Models\Dropdown;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Resources\AttendeesResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\DropdownResource;
use App\Http\Resources\InstitutionResource;

class ReportController extends Controller
{
    public function index($type,$id){
       
        if($type == "Researcher"){
            return $this->researcher($id);
        }else{
            return $this->research($id);
        }
    }

    public function research($id){
        if($id != '-'){
            $r = Organization::findOrFail($id);
            $id = $r->id;
            $name = $r->name;
        }else{
            $id = '';
            $name = 'All Institutions';
        } 

        if(Auth::user()->type == "Secretariat"){
            $id = Auth::user()->organization->organization_id;
            $name = Auth::user()->organization->organization->name;
        }

        $query = Research::query();
        if($id != 0){
            $query->whereHas('user',function ($query) use ($id){
                $query->whereHas('researcher',function ($query) use ($id){
                    ($id != '') ? $query->where('institution_id', $id) : '';
                });
            });
        }
        $research = $query->count();

        $classifications = $this->dropdownlist($id,'Classifications');
        $statuses = $this->dropdownlist($id,'Status');

        $array = [
            'classifications' => $classifications,
            'statuses' => $statuses,
            'name' => $name,
            'count' => $research,
            'type' => 'Research'
        ];

        $pdf = \PDF::loadView('user_common.print-report',$array);
        return $pdf->download('researcher-reports.pdf');

    }

    public function researcher($id){
        

        if($id != '-'){
            $r = Organization::findOrFail($id);
            $id = $r->id;
            $name = $r->name;
        }else{
            $id = '';
            $name = 'All Institutions';
        } 

        if(Auth::user()->type == "Secretariat"){
            $id = Auth::user()->organization->organization_id;
            $name = Auth::user()->organization->organization->name;
        }

        $user = UserProfile::whereHas('user',function ($query) use ($id){
            $query->where('type','Researcher');
            $query->whereHas('researcher',function ($query) use ($id){
                ($id != '') ? $query->where('institution_id',$id) : '';
             });
        })->count();

        $ages = [  
            $data[] = [
                'name' => 'Below 20 years old',
                'count' => $c = UserProfile::agedBetween(0, 20, $id)
            ],
            $data[]  = [
                'name' => '20-30 years old',
                'count' => $c = UserProfile::agedBetween(20, 30, $id)
            ],
            $data[] = [
                'name' => '31-40 years old',
                'count' => $c = UserProfile::agedBetween(31, 40, $id)
            ],
            $data[] = [
                'name' => '41-50 years old',
                'count' => $c = UserProfile::agedBetween(41, 50, $id)
            ],
            $data[] = [
                'name' => '51-60 years old',
                'count' => $c = UserProfile::agedBetween(51, 60, $id)
            ],
            $data[] = [
                'name' => 'Above 60 years old',
                'count' => $c = UserProfile::agedBetween(61, 100, $id)
            ],
        ];

        $gender = [  
            $data[] = [
                'name' => 'Female',
                'count' =>  Researcher::Gender('Female',$id),
            ],
            $data[] = [
                'name' => 'Male',
                'count' =>  Researcher::Gender('Male',$id),
            ],
        ];

        
        $specialties = $this->dropdownlist($id,'Specialties');
        $qualifications = $this->dropdownlist($id,'Qualifications');
        
        $array = [
            'ages' => $ages,
            'gender' => $gender,
            'specialties' => $specialties,
            'qualifications' => $qualifications,
            'name' => $name,
            'count' => $user,
            'type' => 'Researcher'
        ];

        $pdf = \PDF::loadView('user_common.print-report',$array);
        return $pdf->download('researcher-reports.pdf');
    }

    public function dropdownlist($val,$type){
        if($val == '-'){
            $id = '';
        }else{
            $id = explode("*", $val);
            $id = ($id[0] == '-') ? $id = '': $id = $id[0] ;
        }

        if(Auth::user()->type == "Secretariat"){
            $id = Auth::user()->organization->organization_id;
            $name = Auth::user()->organization->name;
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

    public function institution(){
        $data = Organization::select('id','name')->withCount('researchers')->with('researchers:id,institution_id,user_id','researchers.user:id')->where('type_id',3)->get();
        $data = InstitutionResource::collection($data);

        $array = [
            'institutions' => $data,
        ];

        $pdf = \PDF::loadView('user_common.print-report2',$array);
        return $pdf->download('institution-reports.pdf');
    }
 
}

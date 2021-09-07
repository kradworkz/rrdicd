<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Research;
use App\Models\Dropdown;
use Illuminate\Http\Request;
use App\Http\Resources\ResearchResource;

class MyController extends Controller
{
    public function researches($keyword){
       

        ($keyword == '-') ? $keyword = '' : $keyword;
        $query = Research::query();
        $query->with('statuses:status_id,research_id','statuses.status:id,name,color')->with('iprstatus');
        $query->with('classification')->with('user:id,email','user.profile')->with('info');
        $query->where('title','LIKE', '%'.$keyword.'%');
        $query->where('user_id',\Auth::user()->id)->orderBy('created_at','DESC');
        $data = $query->paginate(10);
        return ResearchResource::collection($data);
    }

    public function status()
    {
        $user_id = Auth::user()->id;
        $dropdowns = Dropdown::where('type','Research Status')->where('classification','Status')->get();
        $counts = [];
        foreach($dropdowns as $dropdown){
            
            $count = Research::where('status_id',$dropdown->id)->where('user_id',$user_id)->count();
            $data = [
                'name' => $dropdown->name,
                'color' => $dropdown->color,
                'count' =>  $count
            ];
            array_push($counts,$data);
        }
        return $counts;
    }
}

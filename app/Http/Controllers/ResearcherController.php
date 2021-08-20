<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Researcher;
use Illuminate\Http\Request;
use App\Services\StoreImage;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\ResearcherResource;
use App\Http\Resources\SearchResearcherResource;
use App\Http\Requests\ResearcherRequest;

class ResearcherController extends Controller
{
    public function index(){
        return view('user_common.researcher');
    }

    public function lists($keyword){
        ($keyword == '-') ? $keyword = '' : $keyword;
        
        $query = User::query();
        $query->with('profile')->with('researcher.designation','researcher.institution')
        ->where('type','Researcher')
        ->whereHas('profile',function ($query) use ($keyword) {
            $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%'.$keyword.'%');
        });
        if(Auth::user()->type == "Secretariat"){
            $org_id = Auth::user()->organization->organization_id;
            $query->whereHas('researcher',function ($query) use ($org_id) {
                $query->where('institution_id',$org_id);
            });
        }
        $data = $query->paginate(10);

        return ResearcherResource::collection($data);
    }

    public function store(StoreImage $strmg, ResearcherRequest $request){
        \DB::transaction(function () use ($request,$strmg){

            $data = ($request->input('editable')) ? User::findOrFail($request->input('id')) : new User;
            $data->email = strtolower($request->input('email'));
            $data->password = bcrypt("DostRegion9");
            $data->type = 'Researcher';
            if($data->save()){
                $this->profile($request,$strmg);
            }
        });
    }

    public function profile(Request $request,$strmg){
        $id = ($request->input('id') == '') ? \DB::getPdo()->lastInsertId() : $request->input('id');
        $data = ($request->input('editable')) ? UserProfile::where('user_id',$request->input('id'))->first() : new UserProfile;
        $data->firstname = ucwords(strtolower($request->firstname));
        $data->middlename = ucwords(strtolower($request->middlename));
        $data->lastname = ucwords(strtolower($request->lastname));
        $data->birthdate = $request->birthdate;
        $data->gender = $request->gender;
        $data->mobile_no = $request->mobile;
        $data->user_id = $id;
        if($data->save()){
            $name = strtolower($request->lastname).'-'.$id;
            if($request->input('avatar') != ''){
                $imageName = $strmg->strmg($request->input('avatar'),$name);
            }else{
                ($request->input('editable')) ? $imageName = $data->avatar : $imageName = 'avatar.jpg';
            }
            $data->avatar = $imageName;
            $data->save();

            $this->researcher($request,$id);
        }
    }

    public function researcher(Request $request,$id){
        $organization_id = (!empty(Auth::user()->organization->organization_id)) ? Auth::user()->organization->organization_id : $request->input('institution')['id'];
        $data = new Researcher;
        $data->designation_id = $request->designation['id'];
        $data->specialty_id = $request->specialty['id'];
        $data->institution_id = $organization_id;
        $data->user_id = $id;
        if($data->save()){
            return true;
        }else{
            return false;
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('word');
        $query = User::query();
        $query->with('profile')->where('type','Researcher');
        $query->whereHas('profile',function ($query) use ($keyword) {
            $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%'.$keyword.'%')->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', '%'.$keyword.'%');
        });
        if(Auth::user()->type == "Secretariat"){
            $query->whereHas('researcher',function ($query){
                $query->where('institution_id',Auth::user()->organization->organization_id);
            });
        }
        $data = $query->take(3)->get();

        return SearchResearcherResource::collection($data);
    }
}

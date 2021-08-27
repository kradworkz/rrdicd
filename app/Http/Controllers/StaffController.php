<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\UserOrganization;
use App\Models\UserProfile;
use App\Models\EventAttendance;
use Illuminate\Http\Request;
use App\Services\StoreImage;
use App\Http\Resources\StaffResource;
use App\Http\Resources\MemberResource;
use App\Http\Requests\StaffRequest;
use App\Jobs\EmailNewAccount;

class StaffController extends Controller
{
    public function index(){
        return view('user_common.staff');
    }

    public function lists($keyword){

        if(Auth::user()->type == "Secretariat"){
            $types = ['Laboratory Coordinator','Regular Member'];
            $org_id = Auth::user()->organization->organization_id;
        }else{
            $types = ['Secretariat','Laboratory Coordinator','Regular Member'];
        }

        ($keyword == '-') ? $keyword = '' : $keyword;

        $query = User::query();
        $query->with('organization:organization_id,user_id','organization.organization:id,acronym,name')
        ->whereIn('type',$types)
        ->whereHas('profile',function ($query) use ($keyword) {
            $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%'.$keyword.'%')->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', '%'.$keyword.'%');
        });

        if(Auth::user()->type == "Secretariat"){
            $query->whereHas('organization',function ($query) use ($org_id) {
                $query->where('organization_id',$org_id);
            });
        }
        
        $data = $query->paginate(5);

        return StaffResource::collection($data);
    }

    public function store(StoreImage $strmg, StaffRequest $request){
        \DB::transaction(function () use ($request,$strmg){
            
            $data = ($request->input('editable')) ? User::findOrFail($request->input('id')) : new User;
            $data->email = strtolower($request->input('email'));
            $data->password = (!$request->input('editable')) ? bcrypt("DostRegion9") : ''; 
            $data->type = $request->input('type');
            
            if($data->save()){
                $organization_id = (!empty(Auth::user()->organization->organization_id)) ? Auth::user()->organization->organization_id : $request->input('organization')['id'];
                if(!$request->input('editable')){
                    $consortium = new UserOrganization;
                    $consortium->organization_id = $organization_id;
                    $consortium->user_id = $data->id;
                    $consortium->save();
                }else{
                    $consortium = UserOrganization::where('user_id',$data->id)->first();
                    $consortium->organization_id = $organization_id;
                    $consortium->save();
                }
                
                $profile = ($request->input('editable')) ? UserProfile::where('user_id',$data->id)->first() : new UserProfile;
                $profile->firstname = ucwords(strtolower($request->input('firstname')));
                $profile->lastname = ucwords(strtolower($request->input('lastname')));
                $profile->middlename = ucwords(strtolower($request->input('middlename')));
                $profile->birthdate = $request->input('birthdate');
                $profile->mobile_no = $request->input('mobile');
                $profile->gender = $request->input('gender');
                $profile->user_id = $data->id;
                $profile->save();
                
                if(!$request->input('editable')){
                    $name = strtolower($request->input('lastname')).'-'.$data->id;
                    if($request->input('avatar') != ''){
                        $imageName = $strmg->strmg($request->input('avatar'),$name);
                    }else{
                        ($request->input('editable')) ? $imageName = $data->avatar : $imageName = 'avatar.jpg';
                    }
                    $profile->avatar = $imageName;
                    $profile->save();
                
                    EmailNewAccount::dispatch($data->id)->delay(now()->addSeconds(10));
                    // $expiresAt = now()->addDay();
                    // $data->sendWelcomeNotification($expiresAt);
                }

            }
        });
    }

    public function search(Request $request){
        $keyword = $request->input('word');
        $id = $request->input('event');

        $members = EventAttendance::where('event_id',$id)->pluck('user_id');
    
        if(count($members) == 0){
            $data =  User::where('type','Regular Member')->with('profile')
            ->whereHas('profile',function ($query) use ($keyword) {
                $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%'.$keyword.'%')->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', '%'.$keyword.'%');
            })
            ->take(5)->get();
        }else{
            $data =  User::where('type','Regular Member')->with('profile')
            ->whereNotIn('id',$members)
            ->whereHas('profile',function ($query) use ($keyword) {
                $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%'.$keyword.'%')->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', '%'.$keyword.'%');
            })
            ->take(5)->get();
        }

        return MemberResource::collection($data);
    }

    public function status(Request $request){
        $data = User::findOrFail($request->input('id'));
        $data->status = $request->input('status');
        $data->save();
    }

}

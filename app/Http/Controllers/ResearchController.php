<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Research;
use App\Models\ResearchInfo;
use App\Models\ResearchFile;
use App\Models\ResearchStatus;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\ResearchResource;
use App\Http\Resources\ResearchFileResource;
use App\Http\Requests\UploadRequest;
use App\Http\Requests\ResearchRequest;
use App\Models\ResearchTrainingAttachment as Attachment;

class ResearchController extends Controller
{
    public function index(){
        return view('user_common.research');
    }

    public function research($id){
        $data =  Research::with('user','user.profile')->with('status')->with('iprstatus')->with('classification')
        ->where('id',$id)
        ->first();
        
        return new ResearchResource($data);
    }

    public function lists($keyword){
        ($keyword == '-') ? $keyword = '' : $keyword;
        $query = Research::query();
        $query->with('statuses:status_id,research_id','statuses.status:id,name,color')->with('iprstatus');
        $query->with('classification')->with('user:id,email','user.profile')->with('info');
        $query->where('title','LIKE', '%'.$keyword.'%');
        (\Auth::user()->type == "Researcher") ? $query->where('user_id',\Auth::user()->id)  : '';
        if(Auth::user()->type == "Secretariat"){
            $id = Auth::user()->organization->organization_id;
            $query->whereHas('user',function ($query) use ($id){
                $query->whereHas('researcher',function ($query) use ($id){
                    ($id != '') ? $query->where('institution_id', $id) : '';
                });
            });
        }
        $data = $query->paginate(10);
        return ResearchResource::collection($data);
    }

    public function store(ResearchRequest $request){
        \DB::transaction(function () use ($request){
            
            $i = json_decode($request->iprstatus);
            $c = json_decode($request->classification);
            $r = json_decode($request->researcher);


            (\Auth::user()->type == 'Researcher') ? $user_id = \Auth::user()->id : $user_id = $r->id;
            
            $data = ($request->input('editable') == 'true') ? Research::findOrFail($request->input('id')) : new Research;
            $data->title = ucfirst(strtolower($request->input('title')));
            $data->content = 'Aa';
            $data->iprstatus_id = $i->id;
            $data->classification_id = $c->id;
            $data->user_id = $user_id;
            $data->status_id = ($request->input('old') == 'true') ? $request->input('status') : 5;
            
            if($data->save()){
                if($request->input('old') == 'true'){
                    $info =  ($request->input('editable') == 'true') ? ResearchInfo::where('research_id', $request->input('id'))->first() : new ResearchInfo;
                    $info->amount = $request->input('amount');
                    $info->funded_date = $request->input('date');
                    $info->published_date = $request->input('published');
                    $info->description = $request->input('description');
                    $info->funded_id = $request->input('institution');
                    $info->research_id = $data->id;
                    $info->save();
                }else{
                    $status = new ResearchStatus;
                    $status->status_id = 5;
                    $status->research_id = $data->id;
                    $status->save();
                }
            }
            return new DefaultResource($data);
        });
    }

    public function upload(UploadRequest $request){

        if($request->hasFile('files'))
        {
            $files = $request->file('files');   
            foreach ($files as $file) {
                $file_name = $file->getClientOriginalName();;
                $file_path = $file->storeAs($request->input('id'), $file_name, 'public');

                $data = new ResearchFile;
                $data->path = $file_path;
                $data->research_id = $request->input('id');
                $data->save();
            }

            return new DefaultResource($data);
        }
    }

    public function files($id){
        $data =  ResearchFile::where('research_id',$id)->get();
        return ResearchFileResource::collection($data);
    }

    public function download(Request $request){
        $data = ResearchFile::findOrFail($request->id);
        $path = $data->path;
        return \Storage::download('public/'.$path);
    }

    public function update(Request $request){
        $data = Research::findOrFail($request->id);
        $data->status_id = $request->status;
        if($data->save()){
            $status = new ResearchStatus;
            $status->status_id =  $request->input('status');
            $status->research_id = $data->id;
            $status->save();

            return new DefaultResource($data);
        }
    }
}

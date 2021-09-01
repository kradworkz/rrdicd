<?php

namespace App\Http\Controllers;

use App\Models\Research;
use Illuminate\Http\Request;
use App\Http\Resources\PublicResource;

class PublicController extends Controller
{
    public function search($keyword){
        ($keyword == '-') ? $keyword = '' : $keyword;
        $query = Research::query();
        $query->with('statuses:status_id,research_id','statuses.status:id,name,color')->with('iprstatus');
        $query->with('classification')->with('user:id,email','user.profile')->with('info');
        $query->where('title','LIKE', '%'.$keyword.'%');
        $data = $query->paginate(2);
        return PublicResource::collection($data);
    }
}

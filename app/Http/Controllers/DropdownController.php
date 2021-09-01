<?php

namespace App\Http\Controllers;

use App\Models\Dropdown;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\DropdownResource;
use App\Http\Requests\DropdownRequest;

class DropdownController extends Controller
{
    public function index(){
        return view('user_admin.dropdown');
    }

    public function list($classification,$type,$keyword){
        ($keyword == '-') ? $keyword = '' : $keyword;
        ($type == '-') ? $type = '' : $type;
        $data = Dropdown::where('name','LIKE','%'.$keyword.'%')->where('type','LIKE','%'.$type.'%')->where('classification',$classification)->orderBy('id','DESC')->paginate(5);
        return DefaultResource::collection($data);
    }

    public function lists($classification,$type)
    {
        $query = Dropdown::query();
        ($type != '-') ? $query->where('type',$type) : '';
        $data = $query->where('classification',$classification)->get();

        return DefaultResource::collection($data);
    }

    public function store(DropdownRequest $request){
        $data = new Dropdown;
        $data->name =  ucwords(strtolower($request->input('name')));
        $data->type = ($request->input('type')!= null) ? $request->input('type') : 'n/a';
        $data->classification = $request->input('selected');
        ($request->input('selected') == 'Status') ? $data->color = $request->input('color') : '';
        $data->save();

        return new DefaultResource($data);
    }

    public function count($classification,$type,$val)
    {
         if($val == '-'){
            $id = '';
        }else{
            $id = explode("*", $val);
            $id = ($id[0] == '-') ? '': $id[0] ;
        }

        ($type == '-') ? $type = '' : $type;
        $query = Dropdown::query();
        ($type != '') ? $query->where('type',$type) : '';
        $data = $query->where('classification',$classification)->get();
        
       return $data;

        return DropdownResource::collection($data);
    }
    
}

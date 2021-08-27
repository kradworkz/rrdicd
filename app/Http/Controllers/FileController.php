<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\FileResource;
use App\Http\Requests\FileRequest;

class FileController extends Controller
{
    public function index(){
        return view('user_secretariat.file');
    }

    public function list($keyword){
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = File::where('name','LIKE','%'.$keyword.'%')
        ->orderBy('created_at','DESC')
        ->paginate(5);
        return FileResource::collection($data);
    }

    public function store(Request $request){
        if($request->input('editable')){
            $data = File::findOrFail($request->input('id'));
            $data->name = pathinfo($file_name, PATHINFO_FILENAME);
            $data->path = $file_path;
            $data->save();
        }else{
            if($request->hasFile('files'))
            {
                $files = $request->file('files');   
                foreach ($files as $file) {
                    $file_name = $file->getClientOriginalName();;
                    $file_path = $file->storeAs('uploads', $file_name, 'public');

                    $data = new File;
                    $data->name = pathinfo($file_name, PATHINFO_FILENAME);
                    $data->path = $file_path;
                    $data->save();
                }

                return new DefaultResource($data);
            }
        }
    }

    public function destroy($id){
        $data = File::findOrFail($id);
        $path = $data->path;
        \Storage::delete('public/'.$path);
        $data->delete();

        return new FileResource($data);
    }

    public function today(){
        $data =File::first();
        return new FileResource($data);
    }

    public function download(Request $request){
        $data = File::findOrFail($request->id);
        $path = $data->path;
        return \Storage::download('public/'.$path);
    }
    
}

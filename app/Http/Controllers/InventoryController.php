<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Inventory;
use App\Models\InventoryList;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\InventoryResource;
use App\Http\Resources\EquipmentResource;

class InventoryController extends Controller
{
    public function basic(){
        return view('user_coordinator.basic');
    }

    public function specialized(){
        return view('user_coordinator.specialized');
    }

    public function lists($type,$keyword){
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = Inventory::where('type',$type)->where('name','LIKE','%'.$keyword.'%')
        ->orderBy('created_at','DESC')
        ->paginate(5);

        return InventoryResource::collection($data);
    }

    
    public function equipments($id,$keyword){
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = InventoryList::where('inventory_id',$id)->where('code','LIKE','%'.$keyword.'%')
        ->orderBy('created_at','DESC')
        ->paginate(5);

        return EquipmentResource::collection($data);
    }

    public function store(Request $request){
        \DB::transaction(function () use ($request){
            $data = ($request->input('editable')) ? Inventory::findOrFail($request->input('id')) : new Inventory;
            $data->name = ucwords($request->input('name'));
            $data->quantity = $request->input('quantity');
            $data->description = $request->input('description');
            $data->type = $request->input('type');
            $data->organization_id = Auth::user()->organization->organization_id;
            if($data->save()){
                $this->list($data->type,$data->id,$request->input('quantity'));
                return new DefaultResource($data);
            }
        });
    }

    public function list($type,$id,$quantity){
        $count = 1; 
        ($type == "Basic") ? $type = 'BSC' : $type = 'SPCLZD';

        for($x = 0; $x<$quantity; $x++){
            $data = new InventoryList;
            $data->code = $type.'-'.$id.'-'.str_pad(($count), 4, '0', STR_PAD_LEFT); ;
            $data->inventory_id = $id;
            $data->status_id = 41;
            $data->save();

            $count ++;
        }
    }
}

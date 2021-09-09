<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventAttendance;
use Illuminate\Http\Request;
use App\Http\Resources\EventResource;
use App\Http\Resources\DefaultResource;
use App\Http\Resources\AttendeesResource;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    public function index(){
        return view('user_admin.event');
    }

    public function lists($keyword){
        ($keyword == '-') ? $keyword = '' : $keyword;
        $data = Event::with('status')->with('type')
        ->where(function($q) use ($keyword) {
            $q->where('name','LIKE','%'.$keyword.'%');
        })
        ->orderBy('created_at','DESC')->paginate(5);

        return EventResource::collection($data);
    }

    public function store(EventRequest $request)
    {
         $time = $request->time['hh'].':'.$request->time['mm'].' '.$request->time['A'];
        $time = date("H:i:s", strtotime($time));

        $data = ($request->input('editable')) ? Event::findOrFail($request->input('id')) : new Event;
        $data->name = ucwords($request->input('name'));
        $data->schedule = $request->input('schedule').' '.$time;
        $data->type_id = $request->input('type')['id'];
        $data->location = ucwords($request->input('location'));
        $data->status_id = 5;
        $data->save();

        return new EventResource($data);
    }

    public function attendance(Request $request){

        $validated = $request->validate([
            'member' => 'required',
        ]);
    
        $data = new EventAttendance;
        $data->user_id = $request->input('member');
        $data->event_id = $request->input('event');
        ($request->input('representative') != null) ? $data->representative = $request->input('representative') : '';
        $data->save();

        return new AttendeesResource($data);
    }

    public function remove($id){
        $data = EventAttendance::findOrFail($id);
        $data->delete();

        return true;
    }

    public function attendees($id){
        $data = EventAttendance::
        with('user:id','user.profile:user_id,firstname,lastname,avatar','user.organization:organization_id,id,user_id','user.organization.organization:id,acronym,name')
        ->where('event_id',$id)->orderBy('created_at','DESC')->paginate(5);

        return AttendeesResource::collection($data);
    }

    public function print($id){

        $event = Event::findOrFail($id);

        $data = EventAttendance::with('user:id','user.profile:user_id,firstname,lastname,avatar','user.organization:organization_id,id,user_id','user.organization.organization:id,acronym,name')
        ->where('event_id',$id)->orderBy('created_at','DESC')->get();
        
        
        $array = [
            'members' => AttendeesResource::collection($data),
            'event' => new EventResource($event)
        ];

        $pdf = \PDF::loadView('user_admin.print-attendance',$array);
        return $pdf->stream($event['name'].'.pdf');
    }

    public function today(){
        $data = Event::whereDate('schedule',date('Y-m-d'))->first();
        return new EventResource($data);
    }

    public function save(Request $request)
    {
        $data = Event::findOrFail($request->input('id'));
        $data->content = $request->input('content');
        $data->save();
        return new DefaultResource($data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventAttendance;
use Illuminate\Http\Request;
use App\Http\Resources\EventResource;
use App\Http\Resources\AttendeesResource;

class EventController extends Controller
{
    public function index(){
        return view('user_admin.event');
    }

    public function lists(){
        $data = Event::with('status')->with('type')->orderBy('created_at','DESC')->paginate(5);

        return EventResource::collection($data);
    }

    public function store(Request $request)
    {
        $time = $request->time['hh'].':'.$request->time['mm'].' '.$request->time['A'];
        $time = date("H:i:s", strtotime($time));

        $data = ($request->input('editable')) ? Event::findOrFail($request->input('id')) : new Event;
        $data->name = ucwords($request->input('name'));
        $data->schedule = $request->input('schedule').' '.$time;
        $data->type_id = $request->input('type');
        $data->status_id = 5;
        $data->save();

        return new EventResource($data);
    }

    public function attendance(Request $request){
        $data = new EventAttendance;
        $data->user_id = $request->input('user');
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
        return $pdf->download($event['name'].'.pdf');
    }
}

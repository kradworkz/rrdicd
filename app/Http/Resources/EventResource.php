<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $time = $this->schedule;
        $times = explode(" ", $time);

        $newtime = date('g:i a', strtotime($times[1]));

        $t = explode(" ", $newtime);

        $a = $t[1];

        $n = explode(":", $t[0]);

        $hh = $n[0];
        $mm = $n[1];

        $arr = [
            'A' => strtoupper($a),
            'hh' => $hh,
            'mm' => $mm
        ];

        return [
            'id' => $this->id,
            'name' => $this->name,
            'schedule' => $times[0],
            'date' => $this->date(),
            'time' => $arr,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}

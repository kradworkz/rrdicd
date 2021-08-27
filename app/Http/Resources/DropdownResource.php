<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DropdownResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        if($this->classification == 'Events'){ 
            $count = $this->count();
        }else if($this->classification == 'Qualifications'){
            $count = $this->qualification();
        }else{
            $count = $this->specialty();
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'color' => $this->color,
            'counts' => $count,
        ];
    }
}

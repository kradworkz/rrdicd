<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendeesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user->id,
            'name' => $this->user->profile->firstname.' '.$this->user->profile->lastname,
            'avatar' => $this->user->profile->avatar,
            'institution' => $this->user->organization->organization->name,
            'acronym' => $this->user->organization->organization->acronym,
            'representative' => ($this->representative == null) ? 'n/a' : $this->representative,
            'created_at' => $this->created_at
        ];
    }
}

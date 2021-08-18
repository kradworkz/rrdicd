<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchResearcherResource extends JsonResource
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
            'lastname' => $this->profile->lastname,
            'firstname' => $this->profile->firstname,
            'middlename' => $this->profile->middlename
        ];
    }
}

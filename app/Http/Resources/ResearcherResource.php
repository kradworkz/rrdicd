<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResearcherResource extends JsonResource
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
            'email' => $this->email,
            'status' => $this->status,
            'type' => $this->type,
            'lastname' => $this->profile->lastname,
            'firstname' => $this->profile->firstname,
            'middlename' => $this->profile->middlename,
            'avatar' => $this->profile->avatar,
            'gender' => $this->profile->gender,
            'mobile' => $this->profile->mobile_no,
            'birthdate' => $this->profile->birthdate,
            'lastname' => $this->profile->lastname,
            'designation' => $this->researcher->designation,
            // 'specialty' => $this->researcher->specialty,
            'institution' => $this->researcher->institution,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}

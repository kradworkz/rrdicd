<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
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
            'organization' => $this->organization->organization,
            'lastname' => $this->profile->lastname,
            'firstname' => $this->profile->firstname,
            'middlename' => $this->profile->middlename,
            'gender' => $this->profile->gender,
            'birthdate' => $this->profile->birthdate,
            'mobile' => $this->profile->mobile_no,
            'avatar' => $this->profile->avatar,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}

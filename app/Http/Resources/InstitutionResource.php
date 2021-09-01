<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstitutionResource extends JsonResource
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
            'name' => $this->name,
            'researchers' => $this->researchers_count,
            'research' => array_sum(json_decode(json_encode(CountResource::collection($this->researchers)), true))
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
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
            'code' => $this->code,
            'description' => ($this->description == null) ? 'n/a' : $this->description,
            'purchased_at' => ($this->purchased_at == null) ? 'n/a' : $this->purchased_at,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}

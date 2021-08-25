<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentListResource extends JsonResource
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
            'name' => $this->inventory->name,
            'purchased_at' => ($this->purchased_at == null) ? 'n/a' : $this->purchased_at,
            'status' => $this->status,
            'type' => $this->inventory->type,
            'created_at' => $this->created_at,
        ];
    }
}

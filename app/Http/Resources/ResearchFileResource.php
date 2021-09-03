<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResearchFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $name = explode("/", $this->path);
        return [
            'id' => $this->id,
            'name' => $name[1],
            'created_at' => $this->created_at,
        ];
    }
}

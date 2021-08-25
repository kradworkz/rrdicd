<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PublicationResource extends JsonResource
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
            'title' => $this->title,
            'published' => ($this->info->published_date == null) ? 'n/a' : $this->info->published_date,
            'description' => ($this->info->description == null) ? 'n/a' : $this->info->description
        ];
    }
}

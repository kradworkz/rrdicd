<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResearchResource extends JsonResource
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
            'amount' => ($this->info != null) ? $this->info->amount : '',
            'date' => ($this->info != null) ? $this->info->funded_date : '',
            'institution' => ($this->info != null) ? $this->info->institution : '',
            'period' => ($this->period != null) ? $this->period : 'n/a',
            'iprstatus' => $this->iprstatus,
            'classification' => $this->classification,
            'researcher' => $this->user,
            'status' => new StatusResource($this->status()),
            'created_at' => $this->created_at
        ];
    }
}

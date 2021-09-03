<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PublicResource extends JsonResource
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
            'published' => ($this->info != null) ? $this->info->published_date : '',
            'period' => ($this->period != null) ? $this->period : 'n/a',
            'iprstatus' => $this->iprstatus,
            'classification' => $this->classification,
            'researcher' => new ResearcherResource($this->user),
            'user' => $this->user->profile->firstname.' '.$this->user->profile->lastname,
            'status' => new StatusResource($this->status()),
            'old' => ($this->info != null) ? true : false,
            'created_at' => $this->created_at,
            'files' => ResearchFileResource::collection($this->files)
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearcherEducation extends Model
{
    use HasFactory;

    public function researcher()
    {
        return $this->belongsTo('App\Models\Researcher', 'researcher_id', 'id');
    }
}

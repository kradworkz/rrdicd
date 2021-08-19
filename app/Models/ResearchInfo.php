<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchInfo extends Model
{
    use HasFactory;

    public function research()
    {
        return $this->belongsTo('App\Models\Research', 'research_id', 'id');
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Organization', 'funded_id', 'id');
    }

}

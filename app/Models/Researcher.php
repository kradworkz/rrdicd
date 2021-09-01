<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Researcher extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo('App\Models\Dropdown', 'designation_id', 'id');
    }

    public function specialty()
    {
        return $this->belongsTo('App\Models\Dropdown', 'specialty_id', 'id');
    }

    public function institution()
    {
        return $this->belongsTo('App\Models\Organization', 'institution_id', 'id');
    }

    public function educations()
    {
        return $this->hasMany('App\Models\ResearcherEducation', 'researcher_id');
    } 

    public function trainings()
    {
        return $this->hasMany('App\Models\ResearcherTraining', 'researcher_id');
    } 

    public function scopeGender($query,$type,$id = null){
        $data = $query;
        ($id != null) ? $data = $query->where('institution_id',$id) : '';
        $data = $query->whereHas('user',function ($query) use ($type) {
            $query->whereHas('profile',function ($query) use ($type){
                $query->where('gender',$type);
            });
        })->count();

        return $data;
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }
}

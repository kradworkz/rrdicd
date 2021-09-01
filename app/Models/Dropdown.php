<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Research;
use App\Models\Researcher;
use App\Models\ResearcherEducation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dropdown extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function getColorAttribute($value)
    {
        if($value == 'violet' ){
            return 'primary';
        }else if($value == 'blue'){
            return 'info';
        }else if($value == 'red'){
            return 'danger';
        }else if($value == 'yellow'){
            return 'warning';
        }else if($value == 'black'){
            return 'dark';
        }else if($value == 'gray'){
            return 'secondary';
        }else{
            return 'success';
        }
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function count()
    {
        $count = Event::where('type_id',$this->id)->where('status_id',5)->count();
        return $count;
    }

    public function statuses()
    {
        $count = Research::where('status_id',$this->id)->count();
        return $count;
    }

    public function specialty($id = null)
    {
        $query = Researcher::query();
        ($id != null) ? $query->where('institution_id',$id) : '';
        $count = $query->where('specialty_id',$this->id)->count();
        return $count;
    }

    public function qualification()
    {
        $count = ResearcherEducation::where('qualification_id',$this->id)->count();
        return $count;
    }
}

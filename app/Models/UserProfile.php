<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function scopeAgedBetween($query, $start, $end = null,$id = null)
    {
        if (is_null($end)) {
            $end = $start;
        }

        $now = $this->freshTimestamp();
        $start = $now->subYears($start);
        $start = date('Y-m-d', strtotime($start));
        $end = $now->subYears($end)->addYear()->subDay(); // plus 1 year minus a day
        $end = date('Y-m-d', strtotime($end));

        return $query->whereHas('user',function ($query) use ($id) {
            $query->where('type','Researcher')->whereHas('researcher',function ($query) use ($id){
                ($id != null) ? $query->where('institution_id',$id) : '';
            });
        })
        ->whereBetween('birthdate', [$end, $start])->count();
    }
}

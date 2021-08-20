<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $table = 'researches';

    public function iprstatus()
    {
        return $this->belongsTo('App\Models\Dropdown', 'iprstatus_id', 'id');
    }

    public function classification()
    {
        return $this->belongsTo('App\Models\Dropdown', 'classification_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function info()
    {
        return $this->hasOne('App\Models\ResearchInfo', 'research_id');
    } 

    public function statuses()
    {
        return $this->hasMany('App\Models\ResearchStatus', 'research_id');
    } 

    public function status()
    {
        return $this->hasMany('App\Models\ResearchStatus', 'research_id')->select('status_id')->with('status')->orderBy('created_at', 'desc')->first();
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

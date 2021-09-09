<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public function organization()
    {
        return $this->hasOne('App\Models\UserOrganization', 'organization_id');
    } 

    public function researchinfo()
    {
        return $this->hasOne('App\Models\ResarchInfo', 'organization_id');
    } 

    public function researchers()
    {
        return $this->hasMany('App\Models\Researcher', 'institution_id');
    } 

    public function head()
    {
        $data = User::where('type','Regular Member')->where('status','Active')->whereHas('organization',function ($query){
                    $query->where('organization_id', $this->id)->orderBy('created_at','DESC')->limit(1);
                })->first();

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

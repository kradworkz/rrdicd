<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public function lists()
    {
        return $this->hasMany('App\Models\InventoryList', 'inventory_id');
    } 

    public function quantity()
    {
        return  $this->hasMany('App\Models\InventoryList', 'inventory_id')->count();
    }

    public function available()
    {
        return  $this->hasMany('App\Models\InventoryList', 'inventory_id')->where('status_id',41)->count();
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization', 'organization_id', 'id');
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

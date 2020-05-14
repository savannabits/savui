<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceEndpoint extends Model
{
    protected $fillable = [
        'name',
        'endpoint',
        'description',
        'enabled',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/service-endpoints/'.$this->getKey());
    }
}

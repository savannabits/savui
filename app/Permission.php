<?php

namespace App;

use Laravel\Scout\Searchable;

class Permission extends \Spatie\Permission\Models\Permission
{
    use Searchable;
    protected $fillable = [
        'name',
        'guard_name',
    ];
    protected $searchable = [
        'id',
        'name',
        'guard_name',
        'permission_group'
    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url', 'permission_group', 'display_name'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/permissions/'.$this->getKey());
    }
    public function getDisplayNameAttribute() {
        return str_replace("."," ", ucwords($this->name, " -.\t\r\n\f\v"));
    }
    public function getPermissionGroupAttribute() {
        $parts = explode(".", $this->name);
        if (sizeof($parts) === 2) {
            return $parts[0];
        } elseif(sizeof($parts) ===3) {
            return $parts[1];
        } else {
            return $parts[0];
        }
    }
    public function toSearchableArray()
    {
        return collect($this->only($this->searchable))->toArray();
    }
}

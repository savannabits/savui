<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Role extends \Spatie\Permission\Models\Role
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
    ];

    protected $hidden = [
        'permissions_matrix'
    ];

    protected $dates = [
        'created_at',
        'updated_at',

    ];

//    protected $hidden = ['permissions_matrix'];
    protected $appends = ['resource_url','api_url', 'permissions_matrix', 'display_name'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/roles/'.$this->getKey());
    }
    public function getApiUrlAttribute()
    {
        return url('/api/roles/'.$this->getKey());
    }
    public function getDisplayNameAttribute() {
        return $this->name." [$this->guard_name]";
    }
    public function getPermissionsMatrixAttribute() {
        $role = $this;
        $permissions = Permission::where('guard_name',$this->guard_name)->get()->map(function($item,$key) use (&$role) {
            $item->checked = $role->hasPermissionTo($item);
//            $item->checked = !!$role->permissions()->where("name", "=", $item->name)->first();
            return $item;
        });
        return collect($permissions)->groupBy('permission_group');
    }
    public function toSearchableArray()
    {
        return collect($this->only($this->searchable))->toArray();
    }
}

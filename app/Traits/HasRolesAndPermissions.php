<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

trait HasRolesAndPermissions{


    public function isAdmin()
    {
        if($this->roles->contains('slug','admin')){
            return true;
        }

        return false;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function hasRole($role)
    {
        if($this->roles->contains('slug', $role)){
            return true;
        }

        return false;
    }

}


?>
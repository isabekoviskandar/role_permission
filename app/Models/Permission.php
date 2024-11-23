<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $fillable = ['permission_group_id','key','name'];

    public function roles(){
        return $this->belongsToMany('role_permissions','permission_id','role_id');
    }

    public function permission_groups(){
        return $this->belongsTo(PermissionGroup::class,'permission_group_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    protected $fillable = ['name'];

    
    public function permissions(){
        return $this->hasMany(Permission::class);
    }
}

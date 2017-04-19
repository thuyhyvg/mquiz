<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['slug', 'name'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function role_user()
    {
    	return $this->hasMany('App\RoleUser', 'role_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $fillable = ['user_id', 'role_id'];

    public function roles()
    {
    	return $this->belongsTo('App\Role', 'role_id');
    }

    public function users()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }
}

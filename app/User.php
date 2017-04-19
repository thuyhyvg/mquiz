<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function cauhois()
    {
        return $this->hasMany('App\CauHoi', 'user_id');
    }

    public function baithis()
    {
        return $this->hasMany('App\BaiThi', 'user_id');
    }

    public function isTeacher()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->slug == 'teacher')
            {
                return true;
            }
        }

        return false;
    }

    public function isAdmin()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->slug == 'admin')
            {
                return true;
            }
        }

        return false;
    }

    public function isStudent()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->slug == 'student')
            {
                return true;
            }
        }

        return false;
    }

    public function hocvien_baithi()
    {
        return $this->hasMany('App\HocVienBaiThi', 'user_id');
    }

    public function role_user()
    {
        return $this->hasMany('App\RoleUser', 'user_id');
    }
}

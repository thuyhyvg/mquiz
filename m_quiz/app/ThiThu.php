<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThiThu extends Model
{
    protected $table = 'thi_thu';
    protected $fillable = ['user_id', 'so_lan_thi_thu'];
}

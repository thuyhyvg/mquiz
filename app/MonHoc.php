<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    protected $table = "mon_hoc";
    protected $fillable = ['ten_mon_hoc'];

    public function baithis()
    {
        return $this->hasMany('App\BaiThi', 'mon_hoc_id');
    }

    public function cauhois()
    {
        return $this->hasMany('App\CauHoi', 'mon_hoc_id');
    }

    public function hocvien_baithi()
    {
        return $this->hasMany('App\HocVienBaiThi', 'mon_hoc_id');
    }
}

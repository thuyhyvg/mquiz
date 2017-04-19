<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CauHoi extends Model
{
    protected $table = "cau_hoi";
    protected $fillable = ['mon_hoc_id', 'noi_dung_cau_hoi', 'user_id'];

    public function monhocs()
    {
        return $this->belongsTo('App\MonHoc', 'mon_hoc_id');
    }

    public function baithi_cauhoi()
    {
        return $this->hasMany('App\BaiThiCauHoi', 'cau_hoi_id');
    }

    public function baithis()
    {
        return $this->belongsToMany('App\BaiThi', 'bai_thi_cau_hoi', 'cau_hoi_id', 'bai_thi_id');
    }

    public function dapans()
    {
        return $this->hasMany('App\DapAn', 'cau_hoi_id');
    }

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}

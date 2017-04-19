<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaiThi extends Model
{
    protected $table = "bai_thi";
    protected $fillable = ['mon_hoc_id', 'user_id', 'ten_bai_thi', 'thoi_gian', 'so_cau_hoi', 'khoa'];

    public function cauhois()
    {
        return $this->belongsToMany('App\CauHoi', 'bai_thi_cau_hoi', 'bai_thi_id', 'cau_hoi_id');
    }

    public function monhocs()
    {
        return $this->belongsTo('App\MonHoc', 'mon_hoc_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function hocvien_baithi()
    {
        return $this->hasMany('App\HocVienBaiThi', 'bai_thi_id');
    }
}

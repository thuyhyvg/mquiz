<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HocVienBaiThi extends Model
{
    protected $table = "hoc_vien_bai_thi";
    protected $fillable = ['user_id', 'bai_thi_id', 'mon_hoc_id', 'ket_qua', 'so_cau_dung'];

    public function users()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function baithis()
    {
    	return $this->belongsTo('App\BaiThi', 'bai_thi_id');
    }

    public function monhocs()
    {
    	return $this->belongsTo('App\MonHoc', 'mon_hoc_id');
    }
}

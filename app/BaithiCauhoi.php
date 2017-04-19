<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaiThiCauHoi extends Model
{
    protected $table = "bai_thi_cau_hoi";
    protected $fillable = ['bai_thi_id', 'cau_hoi_id'];
}

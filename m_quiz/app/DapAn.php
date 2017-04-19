<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DapAn extends Model
{
    protected $table = "dap_an";
    protected $fillable = ['cau_hoi_id', 'noi_dung_dap_an', 'dung_sai'];

    public function cauhois()
    {
        return $this->belongsTo('App\CauHoi', 'cau_hoi_id');
    }
}

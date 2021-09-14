<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoreSplited extends Model
{
    protected $fillable = ['status','core_id','odc_id','panel_odc_in','core_odc_in','spliter','panel_odc_out','port_odc_out','dist_odc_out'];

    public function core()
    {
        return $this->belongsTo(Core::class);
    }

    public function odc()
    {
        return $this->belongsTo(Odc::class);
    }

    public function odp()
    {
        return $this->hasOne(Odp::class,'core_splited_id','id');
    }
}

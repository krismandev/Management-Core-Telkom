<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PanelFtmOa extends Model
{
    protected $guarded = [];

    public function ftm_oa()
    {
        return $this->belongsTo(FtmOa::class);
    }

    public function feeder_panel_ftm_oa()
    {
        return $this->hasMany(FeederPanelFtmOa::class,'panel_ftm_oa_id','id');
    }

    public function core()
    {
        return $this->hasMany(Core::class,'panel_ftm_oa_id','id');
    }
}

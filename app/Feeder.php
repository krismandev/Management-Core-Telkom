<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeder extends Model
{
    protected $fillable = ['sto_id','nama_feeder','ftm_oa_id','kapasitas','assign','unassign','core_used','core_avaliable'];

    public function sto()
    {
        return $this->belongsTo(Sto::class);
    }

    public function odc()
    {
        return $this->hasMany(Odc::class,'feeder_id','id');
    }

    public function core()
    {
        return $this->hasMany(Core::class,'feeder_id','id');
    }

    public function feeder_panel_ftm_oa()
    {
        return $this->hasMany(FeederPanelFtmOa::class,'feeder_id','id');
    }
}

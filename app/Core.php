<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Core extends Model
{
    protected $guarded = [];

    public function feeder()
    {
        return $this->belongsTo(Feeder::class);
    }

    public function core_splited()
    {
        return $this->hasMany(CoreSplited::class,'core_id','id');
    }

    public function odc()
    {
        return $this->belongsTo(Odc::class);
    }

    public function odp()
    {
        return $this->hasMany(Odp::class,'core_id','id');
    }

    public function panel_ftm_oa()
    {
        return $this->belongsTo(PanelFtmOa::class);
    }

    public function olt()
    {
        return $this->belongsTo(Olt::class);
    }

    public function slot_olt()
    {
        return $this->belongsTo(SlotOlt::class);
    }
}

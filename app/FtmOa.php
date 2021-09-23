<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FtmOa extends Model
{
    protected $guarded = [];

    public function sto()
    {
        return $this->belongsTo(Sto::class);
    }

    public function panel_ftm_oa()
    {
        return $this->hasMany(PanelFtmOa::class,'ftm_oa_id','id');
    }

    public function feeder()
    {
        return $this->hasMany(Feeder::class);
    }
}

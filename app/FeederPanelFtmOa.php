<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeederPanelFtmOa extends Model
{
    protected $guarded = [];

    public function panel_ftm_o()
    {
        return $this->belongsTo(PanelFtmOa::class);
    }

    public function feeder()
    {
        return $this->belongsTo(Feeder::class);
    }
}

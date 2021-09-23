<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Olt extends Model
{
    protected $guarded = [];
    public function sto()
    {
        return $this->belongsTo(Sto::class);
    }

    public function slot_olt()
    {
        return $this->hasMany(SlotOlt::class);
    }

    public function core()
    {
        return $this->hasMany(Core::class,'olt_id','id');
    }
}

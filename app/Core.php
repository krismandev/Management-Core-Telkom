<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Core extends Model
{
    protected $fillable = ['feeder_id','odc_id','no_core_feeder'];

    public function feeder()
    {
        return $this->belongsTo(Feeder::class);
    }

    public function core_splited()
    {
        return $this->hasMany(CoreSplited::class,'core_id','id');
    }

    public function odp()
    {
        return $this->hasMany(Odp::class,'core_id','id');
    }
}

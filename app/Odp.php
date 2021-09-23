<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Odp extends Model
{

    // protected $fillable = ['core_id','core_splited_id','no_odp','nama_frame_odp','nama_odp','long','lat'];
    protected $guarded = [];

    public function core_splited()
    {
        return $this->belongsTo(CoreSplited::class);
    }

    public function core()
    {
        return $this->belongsTo(Core::class);
    }
}

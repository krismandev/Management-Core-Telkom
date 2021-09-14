<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Odc extends Model
{
    protected $fillable = ['feeder_id','nama_odc','start_core','end_core','long','lat','kapasitas','alamat'];

    public function feeder()
    {
        return $this->belongsTo(Feeder::class);
    }

    public function core()
    {
        return $this->hasMany(Core::class,'odc','id');
    }
}

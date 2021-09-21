<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sto extends Model
{
    protected $fillable = ['nama_sto','alamat'];

    public function feeder()
    {
        return $this->hasMany(Feeder::class,'sto_id','id');
    }

    public function sto()
    {
        return $this->hasMany(Olt::class,'sto_id','id');
    }

    public function ftm_oa()
    {
        return $this->hasMany(FtmOa::class,'sto_id','id');
    }
}

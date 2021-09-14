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
}

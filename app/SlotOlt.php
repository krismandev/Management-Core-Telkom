<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlotOlt extends Model
{
    protected $guarded = []; //
    public function olt()
    {
        return $this->belongsTo(Olt::class);
    }
}

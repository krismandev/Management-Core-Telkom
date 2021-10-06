<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeder extends Model
{
    protected $fillable = ['sto_id','nama_feeder','ftm_oa_id','kapasitas','assign','unassign','core_used','core_avaliable'];

    public function sto()
    {
        return $this->belongsTo(Sto::class);
    }

    public function odc()
    {
        return $this->hasMany(Odc::class,'feeder_id','id');
    }

    public function core()
    {
        return $this->hasMany(Core::class,'feeder_id','id');
    }

    public function ftm_oa()
    {
        return $this->belongsTo(FtmOa::class);
    }

    public function jumlah_core_aktif()
    {
        $core_aktif = Core::where('feeder_id',$this->id)->where('panel_odc_in','!=',null)->count();
        return $core_aktif;
    }

    public function jumlah_odp_aktif()
    {
        $odp_aktif = 0;
        $cores = Core::where('feeder_id',$this->id)->get();
        // dd($cores);
        foreach ($cores as $core) {
            foreach ($core->core_splited as $core_splited) {
                if ($core_splited->odp->status == 'assigned') {
                    $odp_aktif++;
                }
            }
        }
        return $odp_aktif;
    }

    public function core_assigned()
    {
        $cores = Core::where('feeder_id',$this->id)->where('panel_odc_in','!=',null)->count();
        return $cores;
    }

    public function core_unasigned()
    {
        $cores = Core::where('feeder_id',$this->id)->where('panel_odc_in',null)->count();
        return $cores;
    }
}

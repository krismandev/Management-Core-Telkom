<?php

use App\Feeder;
use App\Odc;
use App\Odp;
use App\Sto;

function jumlah_sto()
{
    $jumlah_sto = Sto::count();
    return $jumlah_sto;
}

function jumlah_feeder()
{
    $jumlah_feeder = Feeder::count();
    return $jumlah_feeder;
}

function jumlah_odp_aktif()
{
    $odp = Odp::where('status','assigned')->count();
    return $odp;
}
function jumlah_odc()
{
    $odc = Odc::count();
    return $odc;
}


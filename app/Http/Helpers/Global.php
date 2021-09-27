<?php

use App\Feeder;
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


<?php

namespace App\Http\Controllers;

use App\FtmOa;
use App\PanelFtmOa;
use App\Sto;
use Illuminate\Http\Request;

class PanelFtmOaController extends Controller
{
    public function getPanelFtmOa($sto_id,$ftm_oa_id)
    {
        $panels = PanelFtmOa::where('ftm_oa_id',$ftm_oa_id)->get();
        $ftm_oa = FtmOa::find($ftm_oa_id);
        $sto = Sto::find($sto_id);
        return view('ftm.panel',compact(['panels','ftm_oa','sto']));
    }
}

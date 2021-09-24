<?php

namespace App\Http\Controllers;

use App\FtmOa;
use App\PanelFtmOa;
use App\Sto;
use Illuminate\Http\Request;

class FtmOaController extends Controller
{

    public $pesan_delete = ['success'=>'Berhasil Menghapus data'];
    public $pesan_create = ['success'=> 'Berhasil menambahkan data'];
    public $pesan_update = ['success' => 'Berhasil mengupdate data'];


    public function getFtmOa($sto_id)
    {
        $ftms = FtmOa::where('sto_id', $sto_id)->get();
        $sto = Sto::find($sto_id);
        return view('ftm.ftm',compact(['ftms','sto']));
    }

    public function storeFtmOa(Request $request, $sto_id)
    {
        $request->validate([
            'nama_ftm' => 'required',
            'no_rak' => 'required'
        ]);

        $ftm_oa = FtmOa::create([
            'sto_id'=>$sto_id,
            'nama_ftm'=>$request->nama_ftm,
            'no_rak'=>$request->no_rak,
        ]);

        for ($i=1; $i <= 7; $i++) {
            PanelFtmOa::create([
                'ftm_oa_id'=> $ftm_oa->id,
                'no_panel' => $i
            ]);
        }

        return back()->with($this->pesan_create);
    }

    public function updateFtmOa(Request $request,$sto_id)
    {
        $request->validate([
            'nama_ftm' => 'required',
            'no_rak' => 'required'
        ]);

        $ftm = FtmOa::find($request->ftm_oa_id);
        $ftm->update([
            'nama_ftm' => $request->nama_ftm,
            'no_rak' => $request->no_rak
        ]);

        return back()->with('success','Berhasil mengupdate data');
    }
}

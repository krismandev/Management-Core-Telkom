<?php

namespace App\Http\Controllers;

use App\Core;
use App\CoreSplited;
use App\Feeder;
use App\FtmOa;
use App\Odc;
use App\Odp;
use App\PanelFtmOa;
use App\Sto;
use Illuminate\Http\Request;

class FeederController extends Controller
{
    public $pesan_delete = ['success'=>'Berhasil Menghapus data'];
    public $pesan_create = ['success'=> 'Berhasil menambahkan data'];
    public $pesan_update = ['success' => 'Berhasil mengupdate data'];


    public function getFeeder()
    {
        $feeders = Feeder::orderBy('sto_id')->get();
        $stos = Sto::orderBy('nama_sto')->get();
        return view('feeder.feeder',compact(['feeders','stos']));
    }

    public function getFeederFiltered($sto_id)
    {
        $feeders = Feeder::where('sto_id',$sto_id)->get();
        $sto_selected = Sto::find($sto_id);
        $stos = Sto::orderBy('nama_sto')->get();
        $ftm_oas = FtmOa::where('sto_id',$sto_id)->get();
        return view('feeder.feeder',compact(['feeders','stos','sto_selected','ftm_oas']));
    }

    public function storeFeeder(Request $request)
    {
        $request->validate([
            'nama_feeder' => 'required',
            'kapasitas' => 'required',
            'ftm_oa_id' => 'required',
        ]);

        $feeder = Feeder::create([
            'nama_feeder' => $request->nama_feeder,
            'kapasitas' => $request->kapasitas,
            'sto_id' => $request->sto_id_value,
            'ftm_oa_id' => $request->ftm_oa_id
        ]);

        for ($i=1; $i <= $request->kapasitas; $i++) {
            $core = Core::create([
                'feeder_id' => $feeder->id,
                'no_core_feeder' => $i
            ]);

            // for ($j=0; $j < 4; $j++) {
            //     $core_splited = CoreSplited::create([
            //         'status' => 'idle',
            //         'core_id' => $core->id,
            //     ]);
            // }
        }

        return back()->with($this->pesan_create);
    }

    public function showFeeder($feeder_id)
    {
        // dd("Kok kesini");
        $feeder = Feeder::find($feeder_id);
        $cores = Core::where('feeder_id',$feeder->id)->get();
        $data_odcs = Odc::where('feeder_id',$feeder->id)->get();
        return view('feeder.showFeeder',compact(['feeder','cores','data_odcs','feeder_id']));
    }

    public function showFeederFiltered($id,$odc_id = null){
        if ($odc_id != null) {
            $feeder = Feeder::find($id);
            $odc = Odc::find($odc_id);
            $cores = Core::where('feeder_id',$feeder->id)->where('odc_id',$odc_id)->get();
            $data_odcs = Odc::where('feeder_id',$feeder->id)->get();
        }else{
            $feeder = Feeder::find($id);
            $odc = Odc::find($odc_id);
            $cores = Core::where('feeder_id',$feeder->id)->get();
            $data_odcs = Odc::where('feeder_id',$feeder->id)->get();
        }
        return view('feeder.showFeeder',compact(['feeder','cores','data_odcs','id','odc_id','odc']));
    }

    public function updateFeeder(Request $request)
    {
        $request->validate([
            'nama_feeder' => 'required'
        ]);

        $feeder = Feeder::find($request->feeder_id);
        $feeder->update([
            'nama_feeder' => $request->nama_feeder
        ]);

        return back()->with('success','Berhasil Mengupdate');
    }

    public function markAsBroke($odp_id)
    {
        $odp = Odp::find($odp_id);
        $odp->update([
            "status"=>"RUSAK"
        ]);
        return back();
    }
}

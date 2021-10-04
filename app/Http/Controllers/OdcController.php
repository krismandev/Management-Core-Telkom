<?php

namespace App\Http\Controllers;

use App\Odc;
use App\Feeder;
use App\Core;
use App\CoreSplited;
use App\Odp;
use App\Sto;
use Illuminate\Http\Request;

class OdcController extends Controller
{

    public $pesan_delete = ['success'=>'Berhasil Menghapus data'];
    public $pesan_create = ['success'=> 'Berhasil menambahkan data'];
    public $pesan_update = ['success' => 'Berhasil mengupdate data'];

    public function getOdc()
    {
        $feeders = Feeder::orderBy('nama_feeder')->get();
        $odcs = Odc::orderBy('nama_odc','asc')->get();
        $stos = Sto::all();
        return view('odc.odc',compact(['odcs','feeders','stos']));
    }

    public function getOdcFiltered($sto_id)
    {
        $feeders = Feeder::orderBy('nama_feeder')->get();
        $sto_selected = Sto::find($sto_id);
        $odcs = Odc::select('odcs.id', 'odcs.nama_odc','odcs.start_core','odcs.end_core','odcs.long','odcs.lat','feeders.nama_feeder')->join('feeders','odcs.feeder_id','=','feeders.id')->join('stos','feeders.sto_id','=','stos.id')->where('sto_id',$sto_id)->get();
        // dd($odcs);
        $stos = Sto::all();
        return view('odc.odc',compact(['odcs','feeders','stos','sto_selected']));
    }

    public function storeOdc(Request $request)
    {
        $request->validate([
            'nama_odc' => 'required',
            'start_core' => 'required',
            'end_core' => 'required',
            'feeder_id' => 'required',
            'kapasitas' => 'required',
            'long' => 'required',
            'lat' => 'required',
            'alamat' => 'required',
        ]);

        $odc = ODC::create([
            'feeder_id' => $request->feeder_id,
            'nama_odc'=> $request->nama_odc,
            'start_core' => $request->start_core,
            'end_core' => $request->end_core,
            'long' => $request->long,
            'lat' => $request->lat,
            'kapasitas' => $request->kapasitas,
            'alamat' => $request->alamat
        ]);

        for ($i=$request->start_core; $i <= $request->end_core; $i++) {
            $core = Core::where('feeder_id',$request->feeder_id)->where('no_core_feeder',$i)->first();
            $core->update([
                'odc_id' => $odc->id
            ]);

            // for ($j=0; $j < 4; $j++) {
            //     $coreSplited = CoreSplited::where('core_id',$core->id)->first();
            //     $coreSplited->update([
            //         'odc_id' => $odc->id,
            //     ]);
            // }
        }

        return back()->with($this->pesan_create);
    }

    public function updateOdc(Request $request)
    {
        $request->validate([
            'nama_odc' => 'required',
            'alamat' => 'required'
        ]);

        $odc = Odc::find($request->odc_id);
        $odc->update([
            'nama_odc' => $request->nama_odc,
            'alamat' => $request->alamat,
        ]);

        return back()->with('success','Berhasil Mengupdate ODC');
    }

    public function showOdc($id)
    {
        $odc = Odc::find($id);
        $cores = Core::where('odc_id',$id)->get();
        $feeder = $odc->feeder;
        return view('odc.showOdc',compact(['odc','cores','feeder']));
    }

    public function assignCore(Request $request)
    {
        $request->validate([
            'panel_odc_in' => 'required|numeric',
            'core_odc_in' => 'required|numeric',
            'spliter' => 'required|numeric',
            'olt_id' => 'required',
            'slot_olt_id' => 'required',
            'port_olt'=> 'required',
            'panel' => 'required|numeric',
        ]);

        $core = Core::find($request->core_id);
        // dd($core);
        // dd($request->panel_odc_id);
        $core->update([
            'panel' => $request->panel,
            'olt_id'=>$request->olt_id,
            'slot_olt_id' => $request->slot_olt_id,
            'port_olt'=> $request->port_olt,
            'panel_odc_in' => $request->panel_odc_in,
            'core_odc_in' => $request->core_odc_in,
            'spliter' => $request->spliter
        ]);


        for ($j=1; $j <= 4; $j++) {

            $core_splited = CoreSplited::create([
                'core_id'=>$core->id,
                'odc_id' => $core->odc_id,
            ]);

            $odp = Odp::create([
                'core_id'=> $core->id,
                'core_splited_id' => $core_splited->id,
                'no_odp' => $j,
                'status' => 'IDLE'
            ]);
        }



        return back()->with('success','Berhasil assign core');

    }

    public function assignOdp(Request $request)
    {
        $request->validate([
            'panel_odc_out' => 'required',
            'port_odc_out'=> 'required',
            'dist_odc_out' => 'required',
            'nama_frame_odp' => 'required',
            'nama_odp' => 'required',
            'long' => 'required',
            'lat' => 'required'
        ]);

        // dd($request->core_splited_id);

        $core_splited = CoreSplited::find($request->core_splited_id);
        $odp = Odp::where('core_splited_id',$core_splited->id)->first();

        $core_splited->update([
            'panel_odc_out' => $request->panel_odc_out,
            'port_odc_out' => $request->port_odc_out,
            'dist_odc_out' => $request->dist_odc_out,
            'status' => 'assigned'
        ]);

        $odp->update([
            'nama_odp' => $request->nama_odp,
            'nama_frame_odp' => $request->nama_frame_odp,
            'long' => $request->long,
            'lat' => $request->lat,
            'status' => 'assigned'
        ]);

        return back()->with('success','Berhasil assign ODP');
    }


}

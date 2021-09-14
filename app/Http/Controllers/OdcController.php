<?php

namespace App\Http\Controllers;

use App\Odc;
use App\Feeder;
use App\Core;
use App\CoreSplited;
use App\Odp;
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
        return view('odc.odc',compact(['odcs','feeders']));
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

            for ($j=0; $j < 4; $j++) {
                $coreSplited = CoreSplited::where('core_id',$core->id)->first();
                $coreSplited->update([
                    'odc_id' => $odc->id,
                ]);
            }
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
        return view('odc.showOdc',compact(['odc','cores']));
    }

    public function assignCore(Request $request)
    {
        $request->validate([
            'panel_odc_in' => 'required',
            'core_odc_in' => 'required',
            'spliter' => 'required',
            'panel_odc_out' => 'required',
            'port_odc_out' => 'required',
            'dist_odc_out' => 'required'
        ]);

        $core_splited = CoreSplited::find($request->core_splited_id);

        $core_splited->update([
            'status' => 'assigned',
            'core_odc_in' => $request->core_odc_in,
            'panel_odc_in' => $request->panel_odc_in,
            'spliter' => $request->spliter,
            'panel_odc_out' => $request->panel_odc_out,
            'port_odc_out' => $request->port_odc_out,
            'dist_odc_out' => $request->dist_odc_out,
        ]);

        return back()->with('success','Berhasil assign core');

    }

    public function assignOdp(Request $request)
    {
        $request->validate([
            'nama_frame_odp' => 'required',
            'nama_odp' => 'required',
            'long' => 'required',
            'lat' => 'required'
        ]);

        // $core_splited = CoreSplited::find($request->core_splited_id);
        // dd($core_splited->core);
        $jumlah = Odp::where('core_id', $request->core_id)->count();


        $odp = Odp::create([
            'core_splited_id' => $request->core_splited_id,
            'core_id' => $request->core_id,
            'no_odp' => $jumlah + 1,
            'nama_odp' => $request->nama_odp,
            'nama_frame_odp' => $request->nama_frame_odp,
            'long' => $request->long,
            'lat' => $request->lat
        ]);

        return back()->with('success','Berhasil assign ODP');
    }


}

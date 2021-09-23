<?php

namespace App\Http\Controllers;

use App\Olt;
use App\SlotOlt;
use App\Sto;
use Illuminate\Http\Request;

class OltController extends Controller
{
    public $pesan_delete = ['success'=>'Berhasil Menghapus data'];
    public $pesan_create = ['success'=> 'Berhasil menambahkan data'];
    public $pesan_update = ['success' => 'Berhasil mengupdate data'];


    public function getOlt($sto_id)
    {
        $olts = Olt::where('sto_id',$sto_id)->get();
        $sto = Sto::find($sto_id);
        return view('olt.olt',compact('sto','olts'));
    }

    public function storeOlt(Request $request, $sto_id)
    {
        $request->validate([
            'hostname' => 'required',
            'ip' => 'required',
            'merk' => 'required',
            'type' => 'required',
            'no_frame' => 'required',
            'jumlah_slot' => 'required'
        ]);

        $olt = Olt::create([
            'hostname' => $request->hostname,
            'sto_id' => $sto_id,
            'ip' => $request->ip,
            'merk' => $request->merk,
            'type' => $request->type,
            'no_frame' => $request->no_frame,
            'jumlah_slot' => $request->jumlah_slot,
        ]);

        for ($i=1; $i < $request->jumlah_slot; $i++) {
            $slotOlt = SlotOlt::create([
                'olt_id' => $olt->id,
                'no_slot' => $i
            ]);
        }

        return back()->with($this->pesan_create);
    }

    public function getSlotOlt($olt_id)
    {
        $olt = Olt::find($olt_id);
        $slot_olts = SlotOlt::where('olt_id',$olt->id)->get();
        return response()->json([
            'data' => $slot_olts
        ]);
    }
}

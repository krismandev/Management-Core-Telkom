<?php

namespace App\Http\Controllers;

use App\Sto;
use Illuminate\Http\Request;

class StoController extends Controller
{
    public $pesan_delete = ['success'=>'Berhasil Menghapus data'];
    public $pesan_create = ['success'=> 'Berhasil menambahkan data'];
    public $pesan_update = ['success' => 'Berhasil mengupdate data'];


    public function getSTO()
    {
        $stos = Sto::orderBy('nama_sto')->get();

        return view('sto.sto',compact(['stos']));
    }

    public function storeSTO(Request $request)
    {
        $request->validate([
            'nama_sto' => 'required',
            'alamat' => 'required'
        ]);

        Sto::create([
            'nama_sto' => $request->nama_sto,
            'alamat' => $request->alamat
        ]);

        return back()->with($this->pesan_create);
    }

    public function updateSTO(Request $request)
    {
        $request->validate([
            'nama_sto' => 'required',
            'alamat' => 'required'
        ]);

        $sto = Sto::find($request->sto_id);
        $sto->update([
            'nama_sto' => $request->nama_sto,
            'alamat' => $request->alamat
        ]);

        return back()->with($this->pesan_update);
    }

    public function deleteSTO($id)
    {
        $sto = Sto::find($id);
        $sto->delete();
        return back()->with($this->pesan_delete);
    }

    public function testSto($id)
    {
        return view('coresodc');
    }
}

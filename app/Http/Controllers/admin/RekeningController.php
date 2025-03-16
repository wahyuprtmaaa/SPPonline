<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rekening;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class RekeningController extends Controller
{
    public function index()
    {
        $rekenings = Rekening::all();
        return view('admin.rekening.index', compact('rekenings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_rekening' => 'required|string',
            'bank' => 'required|string',
            'nomor_rekening' => 'required|string|unique:rekenings,nomor_rekening',
            'status' => 'required|integer',
        ]);

        Rekening::create($request->all());
        Alert::toast('Rekening Berhasil DiTambahkan', 'success');
        return redirect()->route('admin.rekening.index')->with('success', 'Rekening berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $rekening = Rekening::find($id);
        $request->validate([
            'nama_rekening' => 'required|string',
            'bank' => 'required|string',
            'nomor_rekening' => 'required|string|unique:rekenings,nomor_rekening,' . $rekening->id,
            'status' => 'required|integer',
        ]);

        if (!$rekening) {
            Alert::warning('Error', 'dData Tidak Ditemukan.');
            return redirect()->route('admin.rekening.index');
        }

        $rekening->update($request->only(['nama_rekening', 'bank', 'nomor_rekening', 'status']));
        Alert::toast('Rekening Berhasil Diupdate', 'success');
        return redirect()->route('admin.rekening.index');
    }

    public function destroy($id)
    {
        $rekening = Rekening::findOrFail($id);
        $rekening->delete();
        Alert::toast('Rekening Berhasil Dihapus', 'success');
        return redirect()->route('admin.rekening.index')->with('success', 'Rekening berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('admin.kelas.index', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kompetensi_keahlian' => 'nullable|string',
        ]);

        Kelas::create($request->all());
        Alert::toast('Kelas Berhasil DiTambahkan', 'success');
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::find($id);
        $request->validate([
            'nama' => 'required|string',
            'kompetensi_keahlian' => 'nullable|string',
        ]);

        $kelas->update($request->all());
        Alert::toast('Kelas Berhasil Diupdate', 'success');
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        Alert::toast('Kelas Berhasil DiHapus', 'success');
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus');
    }
}


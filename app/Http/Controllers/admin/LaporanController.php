<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $laporan = $request->input('laporan');

        if ($laporan == 'wali') {
            $walis = User::role('wali')->get();
            return view('admin.laporan.index', compact('walis', 'laporan'));
        }

        if ($laporan == 'siswa') {
            $siswas = Siswa::with('wali')->get();
            return view('admin.laporan.index', compact('siswas', 'laporan'));
        }

        if ($laporan == 'tagihan') {
            $tagihans = Tagihan::with(['siswa', 'biaya'])->get();
            return view('admin.laporan.index', compact('tagihans', 'laporan'));
        }

        if ($laporan == 'pembayaran') {
            $pembayarans = Pembayaran::with(['siswa'])->get();
            return view('admin.laporan.index', compact('pembayarans', 'laporan'));
        }

        return view('admin.laporan.index', compact('laporan'));
    }

    public function cetakWali()
    {
        $walis = User::role('wali')->get();
        $pdf = Pdf::loadView('admin.laporan.cetak_wali', compact('walis'));
        return $pdf->download('laporan_wali.pdf');
    }

    public function cetakSiswa()
    {
        $siswas = Siswa::with('wali')->get();
        $pdf = Pdf::loadView('admin.laporan.cetak_siswa', compact('siswas'));
        return $pdf->download('laporan_siswa.pdf');
    }

    public function cetakTagihan()
    {
        $tagihans = Tagihan::with(['siswa.wali', 'biaya'])->get();
        $pdf = Pdf::loadView('admin.laporan.cetak_tagihan', compact('tagihans'));
        return $pdf->download('laporan_tagihan.pdf');
    }

    public function cetakPembayaran()
    {
        $pembayarans = Pembayaran::with(['wali.siswa'])->get();
        $pdf = Pdf::loadView('admin.laporan.cetak_pembayaran', compact('pembayarans'));
        return $pdf->download('laporan_pembayaran.pdf');
    }
}

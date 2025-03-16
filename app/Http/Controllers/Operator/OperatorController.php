<?php

namespace App\Http\Controllers\operator;

use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OperatorController extends Controller
{
    public function home()
    {
        $totalTagihan = Tagihan::count();
        $totalPembayaran = Tagihan::where('status', 2)->sum('jumlah');
        $totalSiswa = Siswa::count();
        $totalPembayaranPending = Tagihan::where('status', 0)->count();
        $transaksiTerbaru = Pembayaran::with('tagihan.siswa')->latest()->take(5)->get();

        return view('operator.home', compact(
            'totalTagihan',
            'totalPembayaran',
            'totalSiswa',
            'totalPembayaranPending',
            'transaksiTerbaru'
        ));
    }
}

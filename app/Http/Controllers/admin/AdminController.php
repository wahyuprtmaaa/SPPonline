<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Siswa;

class AdminController extends Controller
{
    public function home()
    {
        $totalTagihan = Tagihan::count();
        $totalPembayaran = Tagihan::where('status', 2)->sum('jumlah');
        $totalSiswa = Siswa::count();
        $totalPembayaranPending = Tagihan::where('status', 0)->count();
        $transaksiTerbaru = Pembayaran::with('tagihan.siswa')->latest()->take(5)->get();

        return view('admin.home', compact(
            'totalTagihan',
            'totalPembayaran',
            'totalSiswa',
            'totalPembayaranPending',
            'transaksiTerbaru'
        ));
    }
}

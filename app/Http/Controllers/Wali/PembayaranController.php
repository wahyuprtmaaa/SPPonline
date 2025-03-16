<?php

namespace App\Http\Controllers\Wali;

use App\Models\Tagihan;
use App\Models\Rekening;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
{

    public function index()
    {
        $tagihans = Tagihan::whereHas('siswa', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->whereIn('status', [0, 1, 3])
            ->with(['siswa' => function ($query) {
                $query->with('kelas', 'wali');
            }])
            ->get();

        return view('wali.pembayaran.index', compact('tagihans'));
    }

    public function create($tagihan_id)
    {
        $tagihan = Tagihan::where('id', $tagihan_id)
            ->whereHas('siswa', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $rekenings = Rekening::where('status', 1)->get();

        return view('wali.pembayaran.create', compact('tagihan', 'rekenings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tagihan_id' => 'required|exists:tagihans,id',
            'rekening_id' => 'required|exists:rekenings,id',
            'jumlah_dibayar' => 'required|numeric|min:1000',
            'tanggal_bayar' => 'required|date',
            'bukti_bayar' => 'required|image|max:2048',
            'nama_rekening_pengirim' => 'required|string|max:255',
            'no_rekening_pengirim' => 'required|string|max:50',
        ]);

        $bukti = $request->file('bukti_bayar')->store('bukti_pembayaran', 'public');

        Pembayaran::create([
            'tagihan_id' => $request->tagihan_id,
            'user_id' => Auth::id(),
            'rekening_id' => $request->rekening_id,
            'jumlah_dibayar' => $request->jumlah_dibayar,
            'tanggal_bayar' => $request->tanggal_bayar,
            'bukti_bayar' => $bukti,
            'nama_rekening_pengirim' => $request->nama_rekening_pengirim,
            'no_rekening_pengirim' => $request->no_rekening_pengirim,
            'status' => 1,
        ]);

        $tagihan = Tagihan::find($request->tagihan_id);
        $tagihan->status = 1;
        $tagihan->save();
        Alert::toast('Pembayaran berhasil diajukan dan sedang menunggu konfirmasi operator.', 'success');
        return redirect()->route('wali.pembayaran.index');
    }


    public function riwayat()
    {
        $pembayarans = Pembayaran::where('user_id', Auth::id())
            ->with(['tagihan.siswa', 'rekening'])
            ->latest()
            ->get();

        return view('wali.pembayaran.riwayat', compact('pembayarans'));
    }

    public function invoice($id)
    {
        $pembayaran = Pembayaran::where('id', $id)
            ->where('user_id', Auth::id())
            ->with(['tagihan.siswa.kelas', 'rekening'])
            ->firstOrFail();

        return view('wali.pembayaran.invoice', compact('pembayaran'));
    }

}

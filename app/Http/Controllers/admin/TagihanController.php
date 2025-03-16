<?php

namespace App\Http\Controllers\Admin;

use App\Models\Biaya;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class TagihanController extends Controller
{
    private $fonnteToken = "@SqS6rjK+-FMg8so1tU1";

    public function index(Request $request)
    {
        $query = Tagihan::with(['siswa.wali', 'biaya']);

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('tanggal_jatuh_tempo', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('tanggal_jatuh_tempo', '<=', $request->end_date);
        }

        $tagihans = $query->paginate(10);
        $tagihans->appends(request()->query());


        return view('admin.tagihan.index', compact('tagihans'));
    }


    public function create()
    {
        $biayas = Biaya::where('status', 1)->get();
        return view('admin.tagihan.create', compact('biayas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'biaya_id' => 'required|exists:biayas,id',
            'tanggal_jatuh_tempo' => 'required|date',
        ]);

        $siswaList = Siswa::with('wali')->get();
        $biaya = Biaya::find($request->biaya_id);

        foreach ($siswaList as $siswa) {
            Tagihan::create([
                'siswa_id' => $siswa->id,
                'biaya_id' => $request->biaya_id,
                'jumlah' => $biaya->jumlah,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'status' => 0,
            ]);

            if ($siswa->wali && $siswa->wali->hasRole('wali') && $siswa->wali->telepon) {
                $message = "Halo {$siswa->wali->name}, tagihan baru telah dibuat untuk siswa {$siswa->nama} dengan jumlah Rp. " . number_format($biaya->jumlah, 0, ',', '.') . ". Jatuh tempo: {$request->tanggal_jatuh_tempo}. Mohon segera melakukan pembayaran.";
                $this->sendWhatsAppMessage($siswa->wali->telepon, $message);
            }
        }

        Alert::toast('Tagihan berhasil dibuat untuk semua siswa.', 'success');
        return redirect()->route('admin.tagihan.index');
    }

    public function destroy($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->delete();
        Alert::toast('Tagihan berhasil dihapus.', 'success');
        return redirect()->route('admin.tagihan.index');
    }

    private function sendWhatsAppMessage($phoneNumber, $message)
    {
        $postData = json_encode([
            'target' => $phoneNumber,
            'message' => $message,
            'countryCode' => '62',
        ]);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => [
                "Authorization: $this->fonnteToken",
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        if ($response === false) {
            Log::error('Error mengirim pesan WhatsApp: ' . curl_error($curl));
        }
        curl_close($curl);
    }
}

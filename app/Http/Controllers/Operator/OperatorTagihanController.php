<?php

namespace App\Http\Controllers\Operator;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class OperatorTagihanController extends Controller
{
    public function index()
    {
        $tagihans = Tagihan::with(['siswa.wali', 'biaya'])->paginate(10);
        return view('operator.tagihan.index', compact('tagihans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $tagihan = Tagihan::findOrFail($id);

        if ($request->has('status')) {
            $tagihan->status = $request->status;
            $tagihan->save();

            Alert::toast('Status tagihan diperbarui!', 'success');
            return redirect()->back();
        }

        return redirect()->back()->with('error', 'Gagal memperbarui status.');
    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $kelas = Kelas::all();
        $wali_users = User::role('wali')->get();
        $siswas = Siswa::with('kelas')
            ->when($query, function ($q) use ($query) {
                $q->where('nama', 'like', "%{$query}%")
                  ->orWhere('nisn', 'like', "%{$query}%")
                  ->orWhere('nis', 'like', "%{$query}%")
                  ->orWhere('telepon', 'like', "%{$query}%")
                  ->orWhereHas('kelas', function ($q) use ($query) {
                      $q->where('nama', 'like', "%{$query}%");
                  });
            })
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.siswa.list', compact('siswas'))->render()
            ]);
        }

        return view('admin.siswa.index', compact('siswas', 'kelas', 'wali_users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:siswas,nisn',
            'nis' => 'required|unique:siswas,nis',
            'nama' => 'required|string',
            'id_kelas' => 'required|exists:kelas,id',
            'alamat' => 'required',
            'telepon' => 'required',
            'foto' => 'nullable|image|max:2048',
            'user_id' => 'nullable|exists:users,id',
        ]);

        if ($request->user_id) {
            $wali = User::where('id', $request->user_id)
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'wali');
                })->first();

            if (!$wali) {
                return redirect()->back()->withErrors(['user_id' => 'User yang dipilih bukan wali.'])->withInput();
            }
        }

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profiles', $filename);
            $data['foto'] = $filename;
        } else {
            $data['foto'] = 'profiles/avatar.png';
        }

        Siswa::create($data);

        Alert::toast('Data Siswa Berhasil ditambahkan', 'success');
        return redirect()->route('admin.siswa.index');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return response()->json(['siswa' => $siswa]);
    }


    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nisn' => 'required|unique:siswas,nisn,' . $id,
            'nis' => 'required|unique:siswas,nis,' . $id,
            'nama' => 'required|string',
            'id_kelas' => 'required|exists:kelas,id',
            'alamat' => 'required',
            'telepon' => 'required',
            'foto' => 'nullable|image|max:2048',
            'user_id' => 'nullable|exists:users,id',
        ]);

        if ($request->user_id) {
            $wali = User::where('id', $request->user_id)
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'wali');
                })->first();

            if (!$wali) {
                return redirect()->back()->withErrors(['user_id' => 'User yang dipilih bukan wali.'])->withInput();
            }
        }

        $data = $request->except(['foto']);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profiles', $filename);
            $siswa->foto = $filename;
        }

        $siswa->update($data);

        Alert::toast('Data Siswa Berhasil Diupdate', 'success');
        return redirect()->route('admin.siswa.index');
    }


    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        Alert::toast('Data Siswa Berhasil Dihapus', 'success');
        return redirect()->route('admin.siswa.index');
    }

    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);

        return view('admin.siswa.show', compact('siswa'));
    }

}

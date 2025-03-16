<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class WaliMuridController extends Controller
{
    public function index()
    {
        $wali = User::role('wali')->paginate(10);
        return view('admin.wali.index', compact('wali'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:15',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->alamat = $request->alamat;
        $user->telepon = $request->telepon;
        $user->status = 1;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profiles', $filename);
            $user->foto = $filename;
        } else {
            $user->foto = 'profiles/avatar.png';
        }

        $user->save();
        $user->assignRole('wali');
        Alert::toast('Wali murid berhasil ditambahkan', 'success');
        return redirect()->route('admin.wali.index');
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:15',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->telepon = $request->telepon;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profiles', $filename);
            $user->foto = $filename;
        }

        $user->save();
        Alert::toast('Wali Berhasil Diupdate', 'success');
        return redirect()->route('admin.wali.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Alert::toast('Wali Berhasil Dihapus', 'success');
        return redirect()->route('admin.wali.index');
    }

}

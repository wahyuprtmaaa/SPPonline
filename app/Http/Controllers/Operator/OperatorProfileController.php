<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OperatorProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('operator.profiles.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('operator.profiles.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profiles', $filename);

            if ($user->foto && $user->foto !== 'default.png') {
                Storage::delete('public/profiles/' . $user->foto);
            }

            $user->foto = $filename;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->telepon = $request->telepon;
        $user->save();

        return redirect()->route('operator.profiles.index')->with('success', 'Profil berhasil diperbarui.');
    }


}

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (auth()->user()->hasRole(['admin'])) {
            return redirect('admin/home');
        } elseif (auth()->user()->hasRole(['guru'])) {
            return redirect('guru/home');
        } elseif (auth()->user()->hasRole(['siswa'])) {
            return redirect('siswa/home');
        } else {
            return redirect('/');
        }
    }
}

<?php

namespace App\Http\Controllers\wali;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WaliController extends Controller
{
    public function home()
    {
        return view('wali.home');
    }
}

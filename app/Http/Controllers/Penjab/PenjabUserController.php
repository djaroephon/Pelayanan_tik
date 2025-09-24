<?php

namespace App\Http\Controllers\Penjab;

use App\Http\Controllers\Controller;

class PenjabUserController extends Controller
{
    public function index()
    {
        return view('penjab.dashboard');
    }
}

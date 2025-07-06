<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $alat = Alat::all();
        return view('welcome', compact('alat'));
    }
}

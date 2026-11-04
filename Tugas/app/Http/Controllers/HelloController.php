<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa; 
use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all(); 
        return view('hello', compact('mahasiswa')); 
    }
}
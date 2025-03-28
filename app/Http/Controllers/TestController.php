<?php

namespace App\Http\Controllers;

use App\Models\Test; 

class TestController extends Controller
{
    public function index()
    {
        $data = Test::all(); 
        return view('test.index', compact('data'));
    }
}


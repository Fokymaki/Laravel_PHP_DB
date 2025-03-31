<?php

namespace App\Http\Controllers;
use App\Models\ServicesManager;


class ServicesManagerController extends Controller
{
    public function index()
  {
      $services= ServicesManager::all();
      
  }
}

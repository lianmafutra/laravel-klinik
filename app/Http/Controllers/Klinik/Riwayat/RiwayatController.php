<?php

namespace App\Http\Controllers\Klinik\Riwayat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(){
      return view('app.riwayat.index');
    }

    public function show($user_id){
      
      return view('app.riwayat.show');
    }
}

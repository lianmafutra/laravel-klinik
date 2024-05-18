<?php

namespace App\Http\Controllers\Klinik\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
   public function pemeriksaan()
   {
     
  
     return view('app.laporan.pemeriksaan');
   }

   public function obat()
   {
     
  
     return view('app.laporan.obat');
   }
}

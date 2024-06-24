<?php

namespace App\Http\Controllers\Klinik;

use App\Http\Controllers\Controller;


class PanduanController extends Controller
{
   public function buku()
   {
       return view('app.panduan.buku');
   }

   public function video()
   {
      return view('app.panduan.video');
   }
}

<?php

namespace App\Http\Controllers\Klinik\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class PenyesuaianStokObatController extends Controller
{
    public function index(){
      $x['obat'] = Obat::get();
      return view('app.master.penyesuaian-stok-obat.index', $x);
    }

    public function riwayat(){
      $x['obat'] = Obat::get();
      return view('app.master.penyesuaian-stok-obat.riwayat', $x);
    }
}

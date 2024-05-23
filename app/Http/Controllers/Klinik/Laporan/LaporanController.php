<?php

namespace App\Http\Controllers\Klinik\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
   public function pemeriksaan()
   {

      $x['pasien'] = Pasien::get();
      return view('app.laporan.pemeriksaan', $x);
   }

   public function cetakLaporanPemeriksaan(Request $request)
   {

      $start_date = urldecode(request()->get('start_date'));
      $end_date = urldecode(request()->get('end_date'));

      $startDate = Carbon::createFromFormat('d/m/Y', urldecode(request()->get('start_date')))->translatedFormat('Y/m/d');
      $endDate = Carbon::createFromFormat('d/m/Y', urldecode(request()->get('end_date')))->translatedFormat('Y/m/d');

      if (request()->get('jenis_laporan') == "semua_pasien") {
         $data =  Pemeriksaan::whereBetween('tgl_pemeriksaan', [$startDate, $endDate])->get();
      }
      if (request()->get('jenis_laporan') == "pasien_tertentu") {
        $pasien = Pasien::where('id', request()->get('pasien_id'))->first();
         $data =  Pemeriksaan::whereBetween('tgl_pemeriksaan', [$startDate, $endDate])->where('pasien_id', request()->get('pasien_id'))->get();
      }

      if (request()->get('jenis_laporan') == "semua_pasien") {
         return view('app.laporan.cetak-pemeriksaan-semua', compact('data', 'start_date', 'end_date'));
      }
      if (request()->get('jenis_laporan') == "pasien_tertentu") {
         return view('app.laporan.cetak-pemeriksaan-pasien', compact('data', 'start_date', 'end_date','pasien'));
      }
   }

   public function obat()
   {


      return view('app.laporan.obat');
   }
}

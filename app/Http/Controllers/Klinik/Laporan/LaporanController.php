<?php

namespace App\Http\Controllers\Klinik\Laporan;

use App\Http\Controllers\Controller;
use App\Models\AnggotaSiswa;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\PenyesuaianObat;
use App\Models\RikkesSiswaAbsensi;
use App\Models\RikkesSiswaJadwal;
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
         return view('app.laporan.cetak-pemeriksaan-pasien', compact('data', 'start_date', 'end_date', 'pasien'));
      }
   }

   public function rikkesSiswa()
   {
      $data = RikkesSiswaJadwal::get();
      return view('app.laporan.rikkes-siswa', compact('data'));
   }

   public function cetakRikkesSiswa(Request $request)
   {
     
      $jadwal = RikkesSiswaJadwal::find( request()->get('jadwal_rikkes'));
    
      $data =    AnggotaSiswa::with(['rikkes_absensi' => function ($query) {
         $query->where('rikkes_siswa_jadwal_id', request()->get('jadwal_rikkes'));
      }])->get();

      return view('app.laporan.cetak-rikkes-siswa', compact('data','jadwal'));
   }

   public function obat()
   {
      return view('app.laporan.obat');
   }

   public function cetakLaporanObat(Request $request)
   {
     
     

      if( request()->get('jenis_laporan') == 'obat_terkini'){
         $obat = Obat::get();
         $start_date = '';
         $end_date = '';
         $deskripsi = "Laporan Stok Obat Terkini " .Carbon::now()->format('d-m-Y') ;
      }
      if( request()->get('jenis_laporan') == 'obat_penyesuaian'){
      
        
     
         $start_date = urldecode(request()->get('start_date'));
         $end_date = urldecode(request()->get('end_date'));


         $jenis_penyesuaian = request()->get('jenis_penyesuaian');

         $startDate = Carbon::createFromFormat('d/m/Y', urldecode(request()->get('start_date')))->translatedFormat('Y/m/d');
         $endDate = Carbon::createFromFormat('d/m/Y', urldecode(request()->get('end_date')))->translatedFormat('Y/m/d');

       if(  $jenis_penyesuaian != "semua"){
         $obat = PenyesuaianObat::whereBetween('tgl_penyesuaian', [$startDate, $endDate])->where('aksi', $jenis_penyesuaian)->get();
       }else{
         $obat = PenyesuaianObat::whereBetween('tgl_penyesuaian', [$startDate, $endDate])->get();

       }
         
         $deskripsi = "Laporan Penyesuaian Stok Obat";
         return view('app.laporan.cetak-obat-penyesuaian', compact('deskripsi','obat','start_date', 'end_date'));
      }
     
      return view('app.laporan.cetak-obat', compact('deskripsi','obat','start_date', 'end_date'));
   }
}

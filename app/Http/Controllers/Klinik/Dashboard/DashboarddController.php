<?php

namespace App\Http\Controllers\klinik\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pemeriksaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboarddController extends Controller
{
   public function index(Request $request)
   {

      // Ambil data pemeriksaan dari database
      $pemeriksaan = DB::table('pemeriksaan')
         ->select(DB::raw('COUNT(*) as jumlah, YEAR(tgl_pemeriksaan) as year, MONTH(tgl_pemeriksaan) as month'))
         ->groupBy(DB::raw('YEAR(tgl_pemeriksaan), MONTH(tgl_pemeriksaan)'))
         ->orderBy('year')
         ->orderBy('month')
         ->get();

      // Inisialisasi array untuk label dan data
      $labels = [];
      $data = [];

      // Buat range bulan dari 1 sampai 12 (Januari hingga Desember)
      $bulan = range(1, 12);

      // Loop melalui setiap bulan
      foreach ($bulan as $bulanKe) {
         // Cari apakah data pemeriksaan ada untuk bulan tersebut
         $pemeriksaanBulanIni = $pemeriksaan->where('month', $bulanKe)->first();

         // Jika ada, tambahkan jumlahnya ke dalam data
         if ($pemeriksaanBulanIni) {
            $jumlah = $pemeriksaanBulanIni->jumlah;
         } else {
            // Jika tidak ada, set jumlahnya menjadi 0
            $jumlah = 0;
         }

         // Tambahkan label bulan dan jumlah pemeriksaan ke dalam array
         $labels[] = Carbon::create(null, $bulanKe, 1)->format('F');
         $data[] = $jumlah;
      }


      $waktu = Carbon::today()->format('Y-m-d');

      if ($request->waktu == "hari_ini") {
         $waktu = Carbon::today()->format('Y-m-d');
         $data2 = Pemeriksaan::with('dokter', 'pasien')->where('tgl_pemeriksaan',  $waktu);
      } else if ($request->waktu == "minggu_ini") {
         $waktu = Carbon::now()->subDays(7)->format('Y-m-d');
         $data2 = Pemeriksaan::with('dokter', 'pasien')->where('tgl_pemeriksaan', '>=', $waktu);
      } else if ($request->waktu == "bulan_ini") {
         $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
         $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');
         $data2 = Pemeriksaan::with('dokter', 'pasien')->whereBetween('tgl_pemeriksaan', [$startOfMonth, $endOfMonth]);
      } else if ($request->waktu == "tahun_ini") {
         $startOfYear = Carbon::now()->startOfYear()->format('Y-m-d');
         $endOfYear = Carbon::now()->endOfYear()->format('Y-m-d');
         $data2 = Pemeriksaan::with('dokter', 'pasien')->whereBetween('tgl_pemeriksaan', [$startOfYear, $endOfYear]);
      } else {
         $data2 = Pemeriksaan::with('dokter', 'pasien')->where('tgl_pemeriksaan',  $waktu);
      }








      if (request()->ajax()) {
         return datatables()->of($data2)
            ->addIndexColumn()
            ->addColumn('kode_rm', function ($data2) {
               return $data2?->pasien?->kode_rm;
            })
            ->addColumn('nama', function ($data2) {
               return $data2?->pasien?->nama;
            })
            ->make(true);
      }


      $waktu22 = Carbon::today()->format('Y-m-d');
      $count_pasien_hari_ini = Pemeriksaan::where('tgl_pemeriksaan',  $waktu22)->count();


      $count_pasien_total = Pemeriksaan::count();

      $startOfMonth2 = Carbon::now()->startOfMonth()->format('Y-m-d');
      $endOfMonth2 = Carbon::now()->endOfMonth()->format('Y-m-d');
      $count_pasien_bulan_ini = Pemeriksaan::with('dokter', 'pasien')->whereBetween('tgl_pemeriksaan', [$startOfMonth2, $endOfMonth2])->count();




      return view('app.dashboard.index', compact('count_pasien_bulan_ini', 'count_pasien_total', 'labels', 'data', 'count_pasien_hari_ini'));
   }
}

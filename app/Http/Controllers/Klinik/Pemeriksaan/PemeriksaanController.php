<?php

namespace App\Http\Controllers\klinik\Pemeriksaan;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemeriksaanRequest;
use App\Models\AnggotaPersonil;
use App\Models\AnggotaSiswa;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\TIndakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemeriksaanController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index($pasien)
   {

      return view('app.pemeriksaan.index');
   }

   public function riwayat()
   {
      $data = Pemeriksaan::with('dokter', 'pasien');
      if (request()->ajax()) {
         return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pemeriksaan.action', compact('data'));
            })
            ->addColumn('kode_rm', function ($data) {
               return $data?->pasien?->kode_rm;
            })
            ->addColumn('nama', function ($data) {
               return $data?->pasien?->nama;
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.pemeriksaan.riwayat-index');
   }

   public function userDetail($kode, $jenis)
   {

      if ($jenis == 'personil') {
         $anggota =  AnggotaPersonil::where('kode', $kode)->first();
      }
      if ($jenis == 'siswa') {
         $anggota =  AnggotaSiswa::where('kode', $kode)->first();
      }


      return $this->success('Data Anggota Detail', $anggota);
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create($user_id)
   {

      $nomor_pemeriksaan = Pemeriksaan::generateNomorPemeriksaan();
      $pasien =  Pasien::find($user_id);
      $x['tindakan'] =  TIndakan::get();
      $x['obat'] = Obat::get();
      $x['dokter'] = Dokter::get();
      return view('app.pemeriksaan.create', $x, compact('pasien','nomor_pemeriksaan'));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(PemeriksaanRequest $request)
   {
      try {

         DB::beginTransaction();

         Pemeriksaan::create(
            $request->safe()->all()
         );


         DB::commit();
         return $this->success(__('trans.crud.success'));
      } catch (\Throwable $th) {
         DB::rollBack();
         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }

   /**
    * Display the specified resource.
    */
   public function show(Pasien $pasien)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Pemeriksaan $pemeriksaan)
   {
    
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, Pasien $pasien)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Pemeriksaan $pemeriksaan)
   {
      try {
         DB::beginTransaction();
         $pemeriksaan->delete();
         DB::commit();

         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();

         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }
}

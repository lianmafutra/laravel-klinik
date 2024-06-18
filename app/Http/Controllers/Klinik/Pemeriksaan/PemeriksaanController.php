<?php

namespace App\Http\Controllers\Klinik\Pemeriksaan;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemeriksaanRequest;
use App\Models\AnggotaPersonil;
use App\Models\AnggotaSiswa;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanObat;
use App\Models\TIndakan;
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

   public function riwayatCetak($pemeriksaan_id){
      $data = Pemeriksaan::with('dokter', 'pasien','pemeriksaan_obat','pemeriksaan_obat.obat')->where('id', $pemeriksaan_id)->first();
      
      return view('app.pemeriksaan.riwayat-cetak', compact('data'));
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

   public function userDetail($id, $jenis)
   {

      if ($jenis == 'personil') {
         $anggota =  AnggotaPersonil::where('id', $id)->first();
      }
      if ($jenis == 'siswa') {
         $anggota =  AnggotaSiswa::where('id', $id)->first();
      }


      return $this->success('Data Anggota Detail', $anggota);
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create($user_id)
   {

      $nomor_pemeriksaan = Pemeriksaan::generateNomorPemeriksaan();

     $pemeriksaanTemp = PemeriksaanObat::doesnthave('pemeriksaan')->delete();
   
      $pasien =  Pasien::find($user_id);
      $x['tindakan'] =  TIndakan::get();
      $x['obat'] = Obat::get();
      $x['dokter'] = Dokter::get();


      return view('app.pemeriksaan.create', $x, compact('pasien', 'nomor_pemeriksaan'));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(PemeriksaanRequest $request)
   {
      try {

      
         DB::beginTransaction();

         $pemeriksaan =  Pemeriksaan::create(
            $request->safe()->all()
         );

         $obat = PemeriksaanObat::where('nomor_pemeriksaan', $request->nomor_pemeriksaan)->get();
     
         foreach ($obat as $key => $value) {
           
            $obat = Obat::where('id',  $value->obat_id);
         
            $obat->update([
               'stok' =>  $obat->first()->stok - $value->jumlah
            ]);
         }

         // if($obat->first()->stok <= 0){
         //    return $this->error("Stok Obat Habis", 400);
         // }

         // if($obat->first()->stok < $request->jumlah ){
         //    return $this->error("Jumlah Obat Kurang, Pastikan jumlah tidak melebihi stok obat tersedia", 400);
         // }



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



      $pasien =  Pasien::find($pemeriksaan->pasien_id);
      $x['tindakan'] =  TIndakan::get();
      $x['obat'] = Obat::get();
      $x['dokter'] = Dokter::get();

      $data = PemeriksaanObat::with('obat', 'pemeriksaan')->where(
         'nomor_pemeriksaan',
         $pemeriksaan->nomor_pemeriksaan
      );


      return view('app.pemeriksaan.edit', $x, compact('pemeriksaan', 'pasien',));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(PemeriksaanRequest $request, Pemeriksaan $pemeriksaan)
   {
      try {

         DB::beginTransaction();

         $pemeriksaan->fill($request->safe()->all())->save();


         DB::commit();
         return $this->success(__('trans.crud.success'));
      } catch (\Throwable $th) {
         DB::rollBack();
         return $this->error(__('trans.crud.error') . $th, 400);
      }
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

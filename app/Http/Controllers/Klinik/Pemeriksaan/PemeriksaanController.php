<?php

namespace App\Http\Controllers\klinik\Pemeriksaan;

use App\Http\Controllers\Controller;
use App\Models\AnggotaPersonil;
use App\Models\AnggotaSiswa;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemeriksaanController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
     
   }

   public function userDetail($user_id, $jenis)
   {

      if ($jenis == 'personil') {
         $anggota =  AnggotaPersonil::where('id', $user_id)->first();
      }
      if ($jenis == 'siswa') {
         $anggota =  AnggotaSiswa::where('id', $user_id)->first();
      }

      return $this->success('Data Anggota Detail', $anggota);
   }

   public function deletePasien(Request $request)
   {
   
   }
   

 

   /**
    * Show the form for creating a new resource.
    */
   public function createPemeriksaan($user_id)
   {
      $x['pasien'] =   Pasien::where('id', $user_id)->with('anggota')->first();
      $x['obat'] = Obat::get();
      $x['dokter'] = Dokter::get();

      return view('app.pemeriksaan.create', $x);
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      //
   }

   /**
    * Display the specified resource.
    */
   public function show(Pemeriksaan $pemeriksaan)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Pemeriksaan $pemeriksaan)
   {
      //
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, Pemeriksaan $pemeriksaan)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Pemeriksaan $pemeriksaan)
   {
      //
   }
}

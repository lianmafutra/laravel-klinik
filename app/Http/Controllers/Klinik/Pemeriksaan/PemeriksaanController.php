<?php

namespace App\Http\Controllers\klinik\Pemeriksaan;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\User;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      $x['anggota'] =  Anggota::get();


      $data = Pasien::with('anggota');
      if (request()->ajax()) {
         return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pemeriksaan.action', compact('data'));
            })
            ->rawColumns(['action'])
            ->make(true);
      }
   
      return view('app.pemeriksaan.index', $x);
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

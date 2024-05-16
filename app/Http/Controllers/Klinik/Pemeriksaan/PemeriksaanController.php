<?php

namespace App\Http\Controllers\klinik\Pemeriksaan;

use App\Http\Controllers\Controller;
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
      $x['users'] =  User::with(['user_detail' => function ($query) {
         $query->whereIn('jenis_user', ['siswa', 'personil', 'pimpinan']);
      }])
         ->has('user_detail')

         ->where('username', '!=', 'superadmin')->select('users.*')->get();


      $data = Pemeriksaan::with('user');
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
   public function create()
   {
      return view('app.pemeriksaan.create');
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

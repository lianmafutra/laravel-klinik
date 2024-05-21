<?php

namespace App\Http\Controllers\klinik\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnggotaPersonilRequest;
use App\Models\AnggotaPersonil;
use App\Models\Jabatan;
use App\Models\Pangkat;
use App\Utils\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaPersonilController extends Controller
{
   use ApiResponse;

   /**
    * Display a listing of the resource.
    */
   public function index(Request $request)
   {

  
      $data = AnggotaPersonil::query();

      if (request()->ajax()) {
         return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.master.anggota-personil.action', compact('data'));
            })

            ->addColumn('umur', function (AnggotaPersonil $data) {
               return  Carbon::parse($data->tgl_lahir)->age . " Tahun";
            })
            

            ->rawColumns(['action',])
            ->make(true);
      }
      return view('app.master.anggota-personil.index');
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      $jabatan = Jabatan::get();
      $pangkat = Pangkat::get();
      return view('app.master.anggota-personil.create', compact('jabatan', 'pangkat'));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(AnggotaPersonilRequest $request)
   {
      try {

         DB::beginTransaction();

         $personil = AnggotaPersonil::create($request->safe()->all());



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
   public function show(AnggotaPersonil $personil)
   {

      return $this->success('data anggota detail', $personil);
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(AnggotaPersonil $personil)
   {
      $jabatan = Jabatan::get();
      $pangkat = Pangkat::get();

    



      return view('app.master.anggota-personil.edit', compact('personil', 'jabatan', 'pangkat'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(AnggotaPersonilRequest $request, AnggotaPersonil $personil)
   {
      try {

         DB::beginTransaction();
         $personil->fill($request->safe()->all())->save();


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
   public function destroy(AnggotaPersonil $personil)
   {
      try {
         DB::beginTransaction();
         $personil->delete();
         DB::commit();

         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();

         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }


   public function userDetail($user_id)
   {
      $personil =  AnggotaPersonil::where('id', $user_id)->first();
      return $this->success('Data Anggota Detail', $personil);
   }
}

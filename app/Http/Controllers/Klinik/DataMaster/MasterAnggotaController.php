<?php

namespace App\Http\Controllers\Klinik\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAnggotaRequest;
use App\Models\Anggota;
use App\Models\Jabatan;
use App\Models\Pangkat;

use App\Utils\ApiResponse;
use Illuminate\Support\Facades\DB;

class MasterAnggotaController extends Controller
{

   use ApiResponse;

  
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      $data = Anggota::query();
 

    
      if (request()->ajax()) {
         return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.master.Anggota.action', compact('data'));
            })

        
            ->addColumn('pangkat_jabatan', function (Anggota $data) {
               return $data?->pangkat . " - " . $data?->jabatan ?? "";
            })
           
            ->rawColumns(['action',])
            ->make(true);
      }
      return view('app.master.anggota.index');
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      $jabatan = Jabatan::get();
      $pangkat = Pangkat::get();
      return view('app.master.anggota.create', compact('jabatan', 'pangkat'));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(MasterAnggotaRequest $request)
   {
      try {

         DB::beginTransaction();

         $anggota = Anggota::create($request->safe()->all());



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
   public function show(Anggota $anggota)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Anggota $anggota)
   {
      $jabatan = Jabatan::get();
      $pangkat = Pangkat::get();

  



      return view('app.master.anggota.edit', compact('anggota', 'jabatan', 'pangkat'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(MasterAnggotaRequest $request, Anggota $anggota)
   {
      try {

         DB::beginTransaction();
         $anggota->fill($request->safe()->all())->save();
       

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
   public function destroy(Anggota $anggota)
   {
      try {
         DB::beginTransaction();
         $anggota->delete();
         DB::commit();

         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();

         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }


   public function userDetail($user_id)
   {
      $anggota =  Anggota::where('id', $user_id)->first();
      return $this->success('Data Anggota Detail', $anggota);
   }
}

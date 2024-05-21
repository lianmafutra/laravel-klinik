<?php

namespace App\Http\Controllers\klinik\DataMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\AnggotaSiswaRequest;
use App\Models\AnggotaSiswa;
use App\Models\Jabatan;
use App\Models\Pangkat;
use App\Utils\ApiResponse;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class AnggotaSiswaController extends Controller
{
   use ApiResponse;

   /**
    * Display a listing of the resource.
    */
   public function index(Request $request)
   {

  
      $data = AnggotaSiswa::query();

      if (request()->ajax()) {
         return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.master.anggota-siswa.action', compact('data'));
            })

            ->addColumn('umur', function (AnggotaSiswa $data) {
               return  Carbon::parse($data->tgl_lahir)->age . " Tahun";
            })
            

            ->rawColumns(['action',])
            ->make(true);
      }
      return view('app.master.anggota-siswa.index');
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      $jabatan = Jabatan::get();
      $pangkat = Pangkat::get();
      return view('app.master.anggota-siswa.create', compact('jabatan', 'pangkat'));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(AnggotaSiswaRequest $request)
   {
      try {

         DB::beginTransaction();

         $anggota = AnggotaSiswa::create($request->safe()->all());



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
   public function show(AnggotaSiswa $siswa)
   {

      return $this->success('data anggota detail', $siswa);
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(AnggotaSiswa $siswa)
   {
      $jabatan = Jabatan::get();
      $pangkat = Pangkat::get();

     
      return view('app.master.anggota-siswa.edit', compact('siswa', 'jabatan', 'pangkat'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(AnggotaSiswaRequest $request, AnggotaSiswa $siswa)
   {
      try {

         DB::beginTransaction();
         $siswa->fill($request->safe()->all())->save();


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
   public function destroy(AnggotaSiswa $siswa)
   {
      try {
         DB::beginTransaction();
         $siswa->delete();
         DB::commit();

         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();

         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }


   public function userDetail($user_id)
   {
      $anggota =  AnggotaSiswa::where('id', $user_id)->first();
      return $this->success('Data Anggota Detail', $anggota);
   }
}

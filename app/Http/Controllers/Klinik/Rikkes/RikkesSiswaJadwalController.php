<?php

namespace App\Http\Controllers\Klinik\Rikkes;

use App\Http\Controllers\Controller;
use App\Http\Requests\RikkesSiswaJadwalRequest;
use App\Models\AnggotaSiswaAngkatan;
use App\Models\RikkesSiswaJadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RikkesSiswaJadwalController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      $data = RikkesSiswaJadwal::with('angkatan');
      if (request()->ajax()) {
         return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.master.rikkes-siswa.action', compact('data'));
            })
            ->addColumn('angkatan', function ($data) {
               return $data?->angkatan?->nama;
            })
            ->rawColumns(['action', 'file_rikkes'])
            ->make(true);
      }
      return view('app.master.rikkes-siswa.index', compact('data'));
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      $angkatan = AnggotaSiswaAngkatan::orderBy('nama', 'DESC')->get();
      return view('app.master.rikkes-siswa.create', compact('angkatan'));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(RikkesSiswaJadwalRequest $request)
   {
      try {

         DB::beginTransaction();
         $rikkesSiswaJadwal = RikkesSiswaJadwal::create($request->all());
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
   public function show(RikkesSiswaJadwal $rikkesSiswaJadwal)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(RikkesSiswaJadwal $rikkesSiswaJadwal)
   {
      $angkatan = AnggotaSiswaAngkatan::orderBy('nama', 'DESC')->get();
      return view('app.master.rikkes-siswa.edit', compact('rikkesSiswaJadwal','angkatan'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(RikkesSiswaJadwalRequest $request, RikkesSiswaJadwal $rikkesSiswaJadwal)
   {
      try {

         DB::beginTransaction();
         $rikkesSiswaJadwal->fill($request->all())->save();

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
   public function destroy(RikkesSiswaJadwal $rikkesSiswaJadwal)
   {
      try {
         DB::beginTransaction();
         $rikkesSiswaJadwal->delete();
         DB::commit();

         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();

         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }
}

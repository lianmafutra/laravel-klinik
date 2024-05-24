<?php

namespace App\Http\Controllers\Klinik\Rikkes;

use App\Http\Controllers\Controller;
use App\Models\AnggotaSiswa;
use App\Models\RikkesSiswaAbsensi;
use App\Models\RikkesSiswaJadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RikkesSiswaAbsensiController extends Controller
{
   public function inputRikkes($jadwal_id)
   {


      $jadwal = RikkesSiswaJadwal::find($jadwal_id);

      $data = AnggotaSiswa::with(['rikkes_absensi' => function ($query) use ($jadwal_id) {
         $query->where('rikkes_siswa_jadwal_id', $jadwal_id);
      }]);

      if (request()->ajax()) {
         return datatables()->of($data)
            ->addIndexColumn()
           
            ->addColumn('action', function ($data) use ($jadwal_id) {

               return view('app.master.rikkes-siswa-absensi.action', compact('data', 'jadwal_id'));
            })
            ->addColumn('tensi', function ($data)  {
               $data = $data?->rikkes_absensi?->first();
               if($data)return $data?->tensi;
            })
            ->addColumn('tinggi', function ($data)  {
               $data = $data?->rikkes_absensi?->first();
               if($data)return $data?->tinggi;
            })
            ->addColumn('bb', function ($data)  {
               $data = $data?->rikkes_absensi?->first();
               if($data)return $data?->bb;
            }) ->addColumn('imt', function ($data)  {
               $data = $data?->rikkes_absensi?->first();
               if($data)return $data?->imt;
            })
            ->addColumn('nilai', function ($data)  {
               $data = $data?->rikkes_absensi?->first();
               if($data)return $data?->nilai;
            })
            ->addColumn('keterangan', function ($data)  {
               $data = $data?->rikkes_absensi?->first();
               if($data)return $data?->keterangan;
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.master.rikkes-siswa-absensi.input-rikkes', compact('jadwal_id','jadwal'));
   }

   public function store(Request $request)
   {
      try {
         DB::beginTransaction();
         $data = RikkesSiswaAbsensi::create($request->all());
         DB::commit();
         return $this->success(__('trans.crud.success'));
      } catch (\Throwable $th) {
         DB::rollBack();
         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }
}

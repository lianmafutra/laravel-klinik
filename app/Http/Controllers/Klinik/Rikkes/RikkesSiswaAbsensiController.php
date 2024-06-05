<?php

namespace App\Http\Controllers\Klinik\Rikkes;

use App\Http\Controllers\Controller;
use App\Models\AnggotaSiswa;
use App\Models\RikkesSiswaAbsensi;
use App\Models\RikkesSiswaJadwal;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RikkesSiswaAbsensiController extends Controller
{
   use ApiResponse;

   public function inputRikkes($jadwal_id)
   {

      $jadwal = RikkesSiswaJadwal::find($jadwal_id);

      $data = AnggotaSiswa::with(['rikkes_absensi' => function ($query) use ($jadwal_id) {
         $query->where('rikkes_siswa_jadwal_id', $jadwal_id);
      }])->where('angkatan_id', $jadwal->angkatan_id);

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

   public function getAbsensiDetail($absensi_id){
      $data = RikkesSiswaAbsensi::where('id',$absensi_id)->first();
      return $this->success('', $data);
   }

   public function store(Request $request)
   {

      try {
         DB::beginTransaction();

         if($request->rikkes_siswa_absensi_id){
         
            $data = RikkesSiswaAbsensi::where('id',$request->rikkes_siswa_absensi_id)->update([
               'tensi' => $request->tensi,
               'tinggi' => $request->tinggi,
               'bb' => $request->bb,
               'imt' => $request->imt,
               'nilai' => $request->nilai,
               'keterangan' => $request->keterangan,
            ]);
         }else{
            $data = RikkesSiswaAbsensi::create(
               $request->except('rikkes_siswa_absensi_id')
            );
         }
       
         DB::commit();
         return $this->success(__('trans.crud.success'));
      } catch (\Throwable $th) {
         DB::rollBack();
         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }
}

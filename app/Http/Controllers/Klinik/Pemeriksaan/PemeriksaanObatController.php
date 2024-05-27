<?php

namespace App\Http\Controllers\Klinik\Pemeriksaan;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanObat;
use App\Utils\ApiResponse;
use App\Utils\Rupiah;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemeriksaanObatController extends Controller
{
   use ApiResponse;
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      //
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      try {


         DB::beginTransaction();

         $obat = Obat::where('id', $request->select_obat);



         if ($obat->first()->stok <= 0) {
            return $this->error("Stok Obat Habis", 400);
         }

         if ($obat->first()->stok < $request->jumlah) {
            return $this->error("Jumlah Obat Kurang, Pastikan jumlah tidak melebihi stok obat tersedia", 400);
         }

         if ($obat?->first()?->tgl_expired != NULL) {
            if ($obat->first()->tgl_expired <= Carbon::today()->format('Y-m-d')) {
               return $this->error("Perhatian, Obat Expired", 400);
            }
         }


         PemeriksaanObat::updateOrCreate(
            [
               "id" => $request->pemeriksaan_obat_id,
            ],
            [
               "nomor_pemeriksaan" => $request->nomor_pemeriksaan,
               "obat_id" =>  $request->select_obat,
               "jumlah" =>  $request->jumlah,
               "dosis_perhari" =>  $request->dosis_perhari,
               "keterangan_obat" =>  $request->keterangan_obat,
            ]
         );


         DB::commit();
         if ($request->pemeriksaan_obat_id) {
            return $this->success(__('trans.crud.update'));
         } else {
            return $this->success(__('trans.crud.success'));
         }
      } catch (QueryException $e) {
         $errorCode = $e->errorInfo[1];
         if ($errorCode == 1062) {
            return $this->error("Data Obat Sudah ada, untuk Menambah Silahkan edit data", 400);
         }
      } catch (\Throwable $th) {
         DB::rollBack();
         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }

   /**
    * Display the specified resource.
    */
   public function show($nomor_pemeriksaan)
   {
      $data = PemeriksaanObat::with('obat', 'pemeriksaan')->where(
         'nomor_pemeriksaan',
         $nomor_pemeriksaan
      );
      if (request()->ajax()) {
         return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pemeriksaan.action-pemeriksaan-obat', compact('data'));
            })
            ->addColumn('harga', function ($data) {
               return "Rp. " . Rupiah::toRupiah($data?->obat?->harga);
            })
            ->addColumn('kode_obat', function ($data) {
               return $data?->obat?->kode_obat;
            })
            ->addColumn('nama_obat', function ($data) {
               return $data?->obat?->nama;
            })
            ->rawColumns(['action'])
            ->make(true);
      }
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit($pemeriksaan_obat_id)
   {

      $pemeriksaanObat = PemeriksaanObat::with('obat', 'pemeriksaan')->find($pemeriksaan_obat_id);
      return $this->success('Data pemeriksaanObat ', $pemeriksaanObat);
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, string $id)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(PemeriksaanObat $pemeriksaanObat)
   {
      try {
         DB::beginTransaction();
         $pemeriksaanObat->delete();
         // $obat = Obat::where('id', $pemeriksaanObat->obat_id);


         // $obat->update([
         //    'stok' =>  $obat->first()->stok + $pemeriksaanObat->jumlah
         // ]);

         DB::commit();

         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();

         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }
}

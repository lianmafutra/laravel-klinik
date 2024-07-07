<?php

namespace App\Http\Controllers\Klinik\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Models\PenyesuaianObat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyesuaianStokObatController extends Controller
{
   public function index()
   {
      $x['obat'] = Obat::get();
      return view('app.master.penyesuaian-stok-obat.index', $x);
   }

   public function riwayat()
   {

      $data = PenyesuaianObat::with('obat');
      if (request()->ajax()) {
         return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.master.penyesuaian-stok-obat.action', compact('data'));
            })
            ->addColumn('obat_nama', function ($data) {
               return  $data?->obat?->kode_obat . "-" . $data?->obat?->nama;
            })

            ->rawColumns(['action'])
            ->make(true);
      }

      return view('app.master.penyesuaian-stok-obat.riwayat');
   }


   public function store(Request $request)
   {
      try {


         DB::beginTransaction();

         $obat = Obat::where('id', $request->select_obat);
         if ($request->penyesuaian_aksi == "penambahan") {
            $obat->update([
               'stok' => $obat->first()->stok + $request->penyesuaian_jumlah_stok
            ]);
         } else if ($request->penyesuaian_aksi == "pengurangan") {
            $obat->update([
               'stok' => $obat->first()->stok - $request->penyesuaian_jumlah_stok
            ]);
         }


         PenyesuaianObat::create([
            "obat_id" => $request->select_obat,
            "nama" => PenyesuaianObat::generateKode(),
            "aksi" => $request->penyesuaian_aksi,
            "stok" => $request->penyesuaian_jumlah_stok,
            "tgl_penyesuaian" =>  Carbon::createFromFormat('d/m/Y', $request->tgl_penyesuaian)->translatedFormat('Y-m-d'),
            "keterangan" => $request->penyesuaian_keterangan,
         ]);

         DB::commit();
         return $this->success(__('trans.crud.success'));
      } catch (\Throwable $th) {
         DB::rollBack();
         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }



   public function hapus($penyesuaian_id)
   {
      try {
         DB::beginTransaction();
        $penyesuaian = PenyesuaianObat::where('id', $penyesuaian_id)->first();
         $obat = Obat::where('id', $penyesuaian->obat_id);
         if ($penyesuaian->aksi == "Penambahan") {
            $obat->update([
               'stok' => $obat->first()->stok - $penyesuaian->stok
            ]);
         } else if ($penyesuaian->aksi == "pengurangan") {
            $obat->update([
               'stok' => $obat->first()->stok + $penyesuaian->stok
            ]);
         }
         $penyesuaian->delete();

         DB::commit();
         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();

         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }
}

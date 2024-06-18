<?php

namespace App\Http\Controllers\klinik\DataMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\AnggotaSiswaRequest;
use App\Imports\SiswaImport;
use App\Models\AnggotaSiswa;
use App\Models\AnggotaSiswaAngkatan;
use App\Models\Jabatan;
use App\Models\Pangkat;
use App\Utils\ApiResponse;
use App\Utils\LmUtils;
use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnggotaSiswaController extends Controller
{
   use ApiResponse;
   protected $lmUtils;

   public function __construct(LmUtils $lmUtils)
   {
      $this->lmUtils = $lmUtils;
   }




   /**
    * Display a listing of the resource.
    */
   public function index(Request $request)
   {








      $angkatan = AnggotaSiswaAngkatan::get();
      $data = AnggotaSiswa::query();

      if (request()->has('angkatan')) {
         $data->where('angkatan_id',   request('angkatan'));
      }

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
      return view('app.master.anggota-siswa.index', compact('angkatan'));
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      $jabatan = Jabatan::get();
      $pangkat = Pangkat::get();
      $angkatan = AnggotaSiswaAngkatan::orderBy('nama', 'DESC')->get();

      return view('app.master.anggota-siswa.create', compact('jabatan', 'pangkat', 'angkatan'));
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
      $angkatan = AnggotaSiswaAngkatan::orderBy('nama', 'DESC')->get();

      return view('app.master.anggota-siswa.edit', compact('siswa', 'jabatan', 'angkatan', 'pangkat'));
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


   public function importExcel(Request $request)
   {
      $this->validate($request, [
         'file' => 'required|mimes:csv,xls,xlsx'
      ]);

      $file = $request->file('file');

      // membuat nama file unik
      $nama_file = $file->hashName();

      //temporary file
      $path = $file->storeAs('public/excel/', $nama_file);

      // import data
      $import = Excel::import(new SiswaImport($request->angkatan), storage_path('app/public/excel/' . $nama_file));

      //remove from server
      Storage::delete($path);

      if ($import) {
         //redirect
         return redirect()->back()->with(['success' => 'Data Berhasil Diimport!']);
      } else {
         //redirect
         return redirect()->back()->with(['error' => 'Data Gagal Diimport!']);
      }
   }


   public function undoImportExcel()
   {
      try {
         DB::beginTransaction();
         // Hitung waktu sekarang dikurangi 1 jam
         $waktuSekarang = SupportCarbon::now()->subHour();

         // Lakukan query untuk menghapus record yang sesuai kriteria
         DB::table('anggota_siswa')
            ->whereNotNull('import_at') // import_at tidak sama dengan NULL
            ->where('import_at', '>=', $waktuSekarang) // import_at kurang atau sama dengan 1 jam dari waktu sekarang
            ->delete();

         DB::commit();

         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();

         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }
}

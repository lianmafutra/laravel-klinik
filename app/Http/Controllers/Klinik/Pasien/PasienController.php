<?php
namespace App\Http\Controllers\klinik\Pasien;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasienRequest;
use App\Models\AnggotaPersonil;
use App\Models\AnggotaSiswa;
use App\Models\Pasien;
use App\Utils\ApiResponse;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PasienController extends Controller
{
   use ApiResponse;
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      $x['siswa'] =  AnggotaSiswa::get();
     
      $data = Pasien::with('personil', 'siswa');
      if (request()->ajax()) {
         return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.pasien.action', compact('data'));
            })
            ->addColumn('umur', function ($data) {
               return Carbon::parse($data->tgl_lahir)->age . " Tahun";
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.pasien.index', $x);
   }


   public function anggotaList($jenis){
  
      if ($jenis == 'personil') {
         $anggota =  AnggotaPersonil::all();
      }
      if ($jenis == 'siswa') {
         $anggota =  AnggotaSiswa::all();
      }

     
      return $this->success('Data Anggota List By Jenis', $anggota);
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
   public function store(PasienRequest $request, Pasien $pasien)
   {
     

   
      try {
         DB::beginTransaction();
         if($request->pasien_id){
            $array = [
               "nama" => $request->nama,
               "alamat" => $request->alamat,
               "jenis_kelamin" => $request->jenis_kelamin,
               // "tinggi_badan" => $request->tinggi_badan,
               "tgl_lahir" => $request->tgl_lahir,
               "no_hp" => $request->no_hp,
            ];
         }
         else{
            if ($request->jenis_anggota == 'personil') {
               $anggota =  AnggotaPersonil::where('id', $request->select_user)->first();
            }
            if ($request->jenis_anggota == 'siswa') {
               $anggota =  AnggotaSiswa::where('id',   $request->select_user )->first();
            }
           
            $kodeRm = Pasien::generateKodeRm();
            $array = [
               "kode_rm" => $kodeRm,
            
               "anggota_jenis" => $request->jenis_anggota,
               "nama" => $request->nama,
               "alamat" => $request->alamat,
               "jenis_kelamin" => $request->jenis_kelamin,
               // "tinggi_badan" => $request->tinggi_badan,
               "tgl_lahir" => $request->tgl_lahir,
               "no_hp" => $request->no_hp,
            ];
         }
         $pasien = Pasien::updateOrCreate(
            ['id' => $request->pasien_id],
         $array   
         );
         DB::commit();
         if($request->pasien_id){
            return $this->success('Update Data Pasien Berhasil');
         }
         else{
            return $this->success('Insert Data Pasien Berhasil');
         }
      } catch (QueryException $e) {
         $errorCode = $e->errorInfo[1];
         if ($errorCode == 1062) {
            return $this->error("Pasien Sudah Pernah Terdaftar, Silahkan Cari dihalaman Pencarian Pasien", 400);
         }
      } catch (\Throwable $th) {
         DB::rollBack();
         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }
   /**
    * Display the specified resource.
    */
   public function show(Pasien $pasien)
   {
      // if($pasien->anggota_jenis == 'personil'){
      //    $pasien
      // }
      // else if($pasien->anggota_jenis == 'siswa'){
      //    $pasien
      // }
      return $this->success('data pasien detail', $pasien);
   }
   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Pasien $pasien)
   {
      //
   }
   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, Pasien $pasien)
   {
      dd($request);
   }
   /**
    * Remove the specified resource from storage.
    */
   public function destroy(Pasien $pasien)
   {
      try {
         DB::beginTransaction();
         $pasien->delete();
         DB::commit();
         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();
         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }
}

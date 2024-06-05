<?php
namespace App\Http\Controllers\Klinik\DataMaster;
use App\Http\Controllers\Controller;
use App\Models\AnggotaSiswaAngkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AnggotaSiswaAngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $data = AnggotaSiswaAngkatan::get();
      if(request()->ajax()){
         return datatables()->of($data)
         ->addIndexColumn()
         ->addColumn('action', function ($data) {
            return view('app.master.angkatan-siswa.action', compact('data'));
         })
         ->rawColumns(['action'])
         ->make(true);
      }
      return view('app.master.angkatan-siswa.index');
    }
    public function create()
    {
      return view('app.master.angkatan-siswa.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try {

         DB::beginTransaction();

         $anggota = AnggotaSiswaAngkatan::create($request->all());



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
    public function show(AnggotaSiswaAngkatan $anggotaSiswaAngkatan)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnggotaSiswaAngkatan $angkatan)
    {
  


      return view('app.master.angkatan-siswa.edit', compact('angkatan'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnggotaSiswaAngkatan $angkatan)
    {
      try {

         DB::beginTransaction();
         $angkatan->fill($request->all())->save();


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
    public function destroy(AnggotaSiswaAngkatan $angkatan)
    {
      try {
         DB::beginTransaction();
         $angkatan->delete();
         DB::commit();
         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();
         return $this->error(__('trans.crud.error') . $th, 400);
      }
    }
}

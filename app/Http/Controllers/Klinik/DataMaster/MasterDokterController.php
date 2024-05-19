<?php

namespace App\Http\Controllers\Klinik\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterDataDokterRequest;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Role;

class MasterDokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $data = Dokter::query();
       if (request()->ajax()) {
          return datatables()->of($data)
             ->addIndexColumn()
             ->addColumn('action', function ($data) {
                return view('app.master.dokter.action', compact('data'));
             })
             ->rawColumns(['action'])
             ->make(true);
       }
       return view('app.master.dokter.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
   
      return view('app.master.dokter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MasterDataDokterRequest $request)
    {
      try {

         DB::beginTransaction();
        

         $dokter = Dokter::create(
            $request->safe()->all()
         );
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
    public function show(Dokter $dokter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokter $dokter)
    {
      return view('app.master.dokter.edit', compact('dokter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MasterDataDokterRequest $request, Dokter $dokter)
    {
      try {

    
         DB::beginTransaction();
      
         $dokter->fill($request->safe()->all())->save();
     


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
    public function destroy(Dokter $dokter)
    {
      try {
         DB::beginTransaction();
         $dokter->delete();
         DB::commit();

         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();

         return $this->error(__('trans.crud.error') . $th, 400);
      }
    }
}

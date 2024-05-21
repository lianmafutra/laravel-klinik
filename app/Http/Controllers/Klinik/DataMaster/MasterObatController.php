<?php

namespace App\Http\Controllers\Klinik\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterObatRequest;
use App\Models\Obat;
use App\Utils\Rupiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $data = Obat::query();
      if (request()->ajax()) {
         return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.master.obat.action', compact('data'));
            })
            ->addColumn('harga_format', function ($data) {
               return    Rupiah::toRupiah($data->harga);
            })
            ->rawColumns(['action'])
            ->make(true);
      }
      return view('app.master.obat.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('app.master.obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MasterObatRequest $request)
    {
      try {

         DB::beginTransaction();
         $user = Obat::create($request->safe()->all());
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
    public function show(Obat $obat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Obat $obat)
    {
      return view('app.master.obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MasterObatRequest $request, Obat $obat)
    {
      try {

         DB::beginTransaction();
         $obat->fill($request->safe()->all())->save();
        
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
    public function destroy(Obat $obat)
    {
      try {
         DB::beginTransaction();
         $obat->delete();
         DB::commit();

         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();

         return $this->error(__('trans.crud.error') . $th, 400);
      }
    }
    
}

<?php

namespace App\Http\Controllers\Klinik\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\TIndakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterTindakanController extends Controller
{
    public function index()
    {
      $data = TIndakan::query();
       if (request()->ajax()) {
          return datatables()->of($data)
             ->addIndexColumn()
             ->addColumn('action', function ($data) {
                return view('app.master.tindakan.action', compact('data'));
             })
             ->rawColumns(['action'])
             ->make(true);
       }
       return view('app.master.tindakan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
   
      return view('app.master.tindakan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try {
       
         DB::beginTransaction();
         $tindakan = TIndakan::create(
            $request->all()
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
    public function show(TIndakan $tindakan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TIndakan $tindakan)
    {
   
      return view('app.master.tindakan.edit', compact('tindakan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TIndakan $tindakan)
    {
      try {

    
         DB::beginTransaction();
      
         $tindakan->fill($request->all())->save();
     


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
    public function destroy(TIndakan $tindakan)
    {
      try {
         DB::beginTransaction();
         $tindakan->delete();
         DB::commit();

         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();

         return $this->error(__('trans.crud.error') . $th, 400);
      }
    }
}

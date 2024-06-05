<?php

namespace App\Http\Controllers\Klinik\Rikkes;

use App\Http\Controllers\Controller;
use App\Models\AnggotaSiswaAngkatan;
use App\Models\Rikkes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RikkesController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
    
      $data = Rikkes::query();
      if (request()->ajax()) {
         return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.master.rikkes.action', compact('data'));
            })
            ->addColumn('file_rikkes', function ($data) {
               return '<a href="' . Storage::disk('public')->url('uploads/' . $data->file_rikkes) . '" target="_blank">' . $data->file_rikkes . '</a>';
            })
            ->rawColumns(['action', 'file_rikkes'])
            ->make(true);
      }
      return view('app.master.rikkes.index', compact('data'));
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
    
      return view('app.master.rikkes.create');
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      try {

         DB::beginTransaction();

         $request->validate([
            'file' => 'required|file|mimes:jpg,xls,xlsx,png,pdf,docx|max:10000',
         ]);

         $file = $request->file('file');
         $fileName = Str::of($file->getClientOriginalName())->basename() . '_' . time() . '.' . $file->getClientOriginalExtension();
         $file->storeAs('public/uploads', $fileName);

         Rikkes::create([
            'nama' => $request->nama,
            'file_rikkes' => $fileName,
         ]);

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
   public function show(Rikkes $rikkes_bintara)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(Rikkes $rikkes_bintara)
   {
      $file = '<a href="' . Storage::disk('public')->url('uploads/' . $rikkes_bintara->file_rikkes) . '" target="_blank">' . $rikkes_bintara->nama . '</a>';
      return view('app.master.rikkes.edit', compact('rikkes_bintara', 'file'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, Rikkes $rikkes_bintara)
   {
      try {



         DB::beginTransaction();

         if ($request->hasFile('file')) {
            $request->validate([
               'file' => 'required|file|mimes:jpg,xls,xlsx,png,pdf,docx|max:10000',
            ]);

            $file = $request->file('file');
            $fileName = Str::of($file->getClientOriginalName())->basename() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads', $fileName);

            $rikkes_bintara->update([
               'nama' => $request->nama,
               'file_rikkes' => $fileName,
            ]);
         } else {
            $rikkes_bintara->update([
               'nama' => $request->nama,
            ]);
         }





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
   public function destroy(Rikkes $rikkes_bintara)
   {
      try {
         DB::beginTransaction();
         $rikkes_bintara->delete();
         DB::commit();

         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();

         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }
}

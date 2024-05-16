<?php

namespace App\Http\Controllers\Klinik\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterDataUserRequest;
use App\Http\Requests\MasterUserRequest;
use App\Models\Jabatan;
use App\Models\Pangkat;
use App\Models\User;
use App\Models\UserDetail;
use App\Services\UserServices;
use App\Utils\ApiResponse;
use App\Utils\DateUtils;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class MasterUserController extends Controller
{

   use ApiResponse;

   protected $userServices;

   public function __construct(UserServices $userServices)
   {
      $this->userServices = $userServices;
   }
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      $data = User::with(['user_detail' => function ($query) {
         $query->whereIn('jenis_user', ['siswa', 'personil', 'pimpinan']);
      }])
         ->has('user_detail')

         ->where('username', '!=', 'superadmin')->select('users.*');

      $x['roles'] = Role::get();
      if (request()->ajax()) {
         return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
               return view('app.master.user.action', compact('data'));
            })

            ->editColumn('foto', function ($data) {
               if ($data?->field('foto')->getFile()) {
                  return '<img class="foto img-circle elevation-3 foto p-0" src="' . $data?->field('foto')->getFile() . '' . '" height="40px" width="40px"; style="object-fit: cover; padding: 0px !important;">';
               } else {
                  return '<img class="foto img-circle elevation-3 foto p-0" src="' . asset('img/avatar.png') . '' . '" height="40px" width="40px"; style="object-fit: cover; padding: 0px !important;">';
               }
            })
            ->addColumn('role', function (User $data) {
               return $this->userServices->getRoleColor($data->getRoleName());
            })
            ->addColumn('last_login_human', function (User $data) {
               return DateUtils::human($data?->last_login_at);
            })
            ->addColumn('jenis_user', function (User $data) {
               return $data?->user_detail->jenis_user ?? "";
            })
            ->addColumn('pangkat_jabatan', function (User $data) {
               return $data?->user_detail?->pangkat . " - " . $data?->user_detail?->jabatan ?? "";
            })
            ->addColumn('nik', function (User $data) {
               return $data?->user_detail->nik ?? "-";
            })
            ->addColumn('nrp', function (User $data) {
               return $data?->user_detail->nrp ?? "-";
            })
            ->editColumn('status', function ($data) {
               if ($data?->status == 'NONAKTIF') {
                  return '<span class="badge badge-danger">Nonaktif</span>';
               }
               if ($data?->status == 'AKTIF') {
                  return '<span class="badge badge-primary">Aktif</span>';
               }
            })
            ->rawColumns(['action',])
            ->make(true);
      }
      return view('app.master.user.index', $x);
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      $jabatan = Jabatan::get();
      $pangkat = Pangkat::get();
      return view('app.master.user.create', compact('jabatan', 'pangkat'));
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(MasterDataUserRequest $request)
   {
      try {

         DB::beginTransaction();

         $user = User::create($request->safe()->only('username', 'password', 'name'));

         $userDetail = UserDetail::create(
            $request->safe()->merge(['user_id' => $user->id])->except('username', 'password', 'name')
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
   public function show(User $user)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(User $user)
   {
      $jabatan = Jabatan::get();
      $pangkat = Pangkat::get();

      return view('app.master.user.edit', compact('user', 'jabatan', 'pangkat'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(MasterDataUserRequest $request, User $user)
   {
      try {

         DB::beginTransaction();
         $user->fill($request->safe()->only('username', 'password', 'name'))->save();
         $user->user_detail->fill($request->safe()->except('username', 'password', 'name'))->save();

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
   public function destroy(User $user)
   {
      try {
         DB::beginTransaction();
         $user->delete();
         DB::commit();

         return $this->success(__('trans.crud.delete'));
      } catch (\Throwable $th) {
         DB::rollBack();

         return $this->error(__('trans.crud.error') . $th, 400);
      }
   }


   public function userDetail($user_id)
   {
      $user =  User::where('id', $user_id)->first();
      return $this->success('Data User Detail', $user);
   }
}

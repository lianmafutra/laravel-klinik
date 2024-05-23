<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserServices;
use App\Utils\ApiResponse;
use App\Utils\DateUtils;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\ResponseCache\Facades\ResponseCache;

class DataUserController extends Controller
{
    use ApiResponse;

    protected $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function index()
    {

        $data = User::with('file_foto', 'user_detail');
        $x['roles'] = Role::get();
        if (request()->ajax()) {
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('admin.master-user.action', compact('data'));
                })
                ->editColumn('foto', function ($data) {
                    if ($data?->field('foto')->getFile()) {
                        return '<img class="foto img-circle elevation-3 foto p-0" src="'.$data?->field('foto')->getFile().''.'" height="40px" width="40px"; style="object-fit: cover; padding: 0px !important;">';
                    } else {
                        return '<img class="foto img-circle elevation-3 foto p-0" src="'.asset('img/avatar.png').''.'" height="40px" width="40px"; style="object-fit: cover; padding: 0px !important;">';
                    }
                })
                ->addColumn('role', function (User $data) {
                    return $this->userServices->getRoleColor($data->getRoleName());
                })
                ->addColumn('last_login_human', function (User $data) {
                    return DateUtils::human($data->last_login_at);
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 'NONAKTIF') {
                        return '<span class="badge badge-danger">Nonaktif</span>';
                    }
                    if ($data->status == 'AKTIF') {
                        return '<span class="badge badge-primary">Aktif</span>';
                    }
                })
                ->rawColumns(['action', 'foto', 'status', 'role'])
                ->make(true);
        }

        return view('admin.master-user.index', $x);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        try {
            $input = $request->except('user_id', 'role');
            $input['password'] = bcrypt('123456');
            $user = User::updateOrCreate(
                ['id' => $request->user_id],
                $input
            );

            $user->syncRoles($request->role);

            return $this->success(config('language.alert-success.store'));
        } catch (\Throwable $th) {
            return $this->error(config('language.alert-error.store').$th, 400);
        }
    }

    public function show($id)
    {

        $user = User::find($id);
        $data = $user->getAllPermissions();

        $permissions = Permission::get();

        if (request()->ajax()) {
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) use ($user) {

                    if ($user->hasDirectPermission($data->name)) {
                        return '<a href="#" data-action="'.$data->name.'"
                  data-url="'.route('master-user.revoke.permission').'" data-toggle="tooltip" data-placement="bottom" title="Delete Data" class="btn btn-sm btn-danger btn_delete" data-id="" data-name=""><i class="fas fa-trash"></i></a>';
                    }
                })
                ->editColumn('created_at', function ($data) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d/m/Y H:i:s');
                })
                ->editColumn('type', function ($data) use ($user) {
                    if ($user->hasDirectPermission($data->name)) {
                        return '<span class="badge badge-warning">Direct</span>';
                    } else {
                        return '<span class="badge badge-success">Via Role</span>';
                    }
                })
                ->editColumn('guard_name', function ($data) {
                    if ($data->guard_name == 'web') {
                        return '<span class="badge badge-primary">'.$data->guard_name.'</span>';
                    } elseif ($data->guard_name == 'api') {
                        return '<span class="badge badge-warning">'.$data->guard_name.'</span>';
                    }
                })
               // ->editColumn('group', function ($data) {
               //   return Group::where();
               // })
                ->rawColumns(['action', 'guard_name', 'type'])
                ->make(true);
        }

        return view('admin.master-user.show', compact('user', 'permissions'));
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        return $this->success('Data Master User', $user);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->delete();
            DB::commit();

            ResponseCache::forget(route('master-user.index'));

            return $this->success(config('language.alert-success.destroy'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->error(config('language.alert-error.destroy').$th, 400);
        }
    }

    public function revokePermission(Request $request)
    {

        try {
            DB::beginTransaction();
            $user = User::find($request->user_id);
            $user->revokePermissionTo($request->permission_name);
            DB::commit();

            return $this->success(config('language.alert-success.destroy'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->error(config('language.alert-error.destroy').$th, 400);
        }
    }

    public function addDirectPermission(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::find($request->user_id);
            $user->givePermissionTo([$request->permission]);
            DB::commit();

            return $this->success(config('language.alert-success.store'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->error(config('language.alert-error.store').$th, 400);
        }
    }

    public function setActiveStatus(Request $request)
    {
        try {

            User::find($request->id)->update([
                'status' => $request->status,
            ]);

            return redirect()->back()->with('success', __('trans.crud.update'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('trans.crud.error'));
        }
    }

    public function passwordReset(Request $request)
    {
        try {
            User::find($request->user_id)->update([
                'password' => bcrypt($request->password_baru),
            ]);

            return redirect()->back()->with('success', __('trans.crud.update'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('trans.crud.error'));
        }
    }
}

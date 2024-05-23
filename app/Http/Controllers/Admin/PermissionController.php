<?php

namespace App\Http\Controllers\Admin;

use App\Models\PermissionGroup;
use App\Utils\ApiResponse;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $data = DB::table('permissions')
            ->select('permissions.*', 'permission_group.name as group')
            ->leftJoin('permission_group', 'permission_group.id', '=', 'permissions.permission_group_id');

        $groupIndex = PermissionGroup::get();
        if (request()->ajax()) {
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('admin.permissions.action', compact('data'));
                })
                ->editColumn('created_at', function ($data) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d/m/Y H:i:s');
                })
                ->editColumn('guard_name', function ($data) {
                    if ($data->guard_name == 'web') {
                        return '<span class="badge badge-primary">'.$data->guard_name.'</span>';
                    } elseif ($data->guard_name == 'api') {
                        return '<span class="badge badge-warning">'.$data->guard_name.'</span>';
                    }
                })
                ->rawColumns(['action', 'guard_name'])
                ->make(true);
        }

        return view('admin.permissions.index', compact('data', 'groupIndex'));
    }

    public function edit($permission_group_id)
    {

        $group = PermissionGroup::findOrFail($permission_group_id);
        $data = Permission::where('permission_group_id', $permission_group_id);
        if (request()->ajax()) {
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('admin.permissions.action', compact('data'));
                })
                ->editColumn('created_at', function ($data) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d/m/Y H:i:s');
                })
                ->editColumn('guard_name', function ($data) {
                    if ($data->guard_name == 'web') {
                        return '<span class="badge badge-primary">'.$data->guard_name.'</span>';
                    } elseif ($data->guard_name == 'api') {
                        return '<span class="badge badge-warning">'.$data->guard_name.'</span>';
                    }
                })
                ->rawColumns(['action', 'guard_name'])
                ->make(true);
        }

        return view('admin.permissions.edit', compact('group', 'data'));
    }

    public function show(Permission $permission)
    {
        return $this->success('Data Edit Permission', $permission);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->has('multi')) {
                $array = explode(',', $request->name);
                foreach ($array as $key => $value) {

                    Permission::create([
                        'name' => trim($value),
                        'permission_group_id' => $request->permission_group_id,
                        'guard_name' => $request->guard_name,
                    ]);
                }
            } else {
                Permission::updateOrCreate(
                    ['id' => $request->permission_id],
                    [
                        'name' => $request->name,
                        'desc' => $request->desc,
                        'permission_group_id' => $request->permission_group_id,
                        'guard_name' => $request->guard_name,
                    ]
                );
            }
            DB::commit();

            return $this->success(config('language.alert-success.store'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->error(config('language.alert-error.store').$th, 400);
        }
    }

    public function update(Permission $permission, Request $request)
    {
        DB::beginTransaction();
        try {
            $permission->update([
                'name' => $request->name,
                'desc' => $request->desc,
                'permission_group_id' => $request->permission_group_id,
                'guard_name' => $request->guard_name,
            ]);
            DB::commit();

            return $this->success(config('language.alert-success.store'));
        } catch (\Throwable $th) {
            DB::rollback();

            return $this->error(config('language.alert-error.store').$th, 400);
        }
    }

    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();

            return redirect()->back()->with('success', config('language.alert-success.destroy'), 200);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', config('language.alert-error.destroy'), 400);
        }
    }
}

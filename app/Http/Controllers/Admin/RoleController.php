<?php

namespace App\Http\Controllers\Admin;

use App\Models\PermissionGroup;
use App\Utils\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $x['title'] = 'Role';
        $data = Role::with('permissions', 'users');
        $x['permission'] = Permission::orderBy('id', 'desc')->get();

        if (request()->ajax()) {
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('admin.role.action', compact('data'));
                })
                ->addColumn('permissions', function ($data) {
                    $permisssions = $data->permissions->count();
                    if ($data->name == 'superadmin') {
                        return 'All';
                    }
                    if ($permisssions > 0) {
                        return '<span style="background-color: rgb(29 185 198) !important" class="badge badge-info">'.$permisssions.'</span>';
                    } else {
                        return '<span class="badge badge-secondary">'.$permisssions.'</span>';
                    }
                })
                ->addColumn('user', function ($data) {
                    $users = $data->users->count();
                    if ($users > 0) {
                        return '<span class="badge badge-primary">'.$users.'</span>';
                    } else {
                        return '<span class="badge badge-secondary">'.$users.'</span>';
                    }
                })
                ->editColumn('created_at', function ($data) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d/m/Y H:i:s');
                })
                ->rawColumns(['action', 'permissions', 'user'])
                ->make(true);
        }

        return view('admin.role.index', $x);
    }

    public function create()
    {
        $x['data'] = PermissionGroup::with(['permissions' => function ($query) {
            $query->orderBy('name', 'ASC');
        }]);

        return view('admin.role.edit');
    }

    public function edit(Role $role)
    {

        $role = Role::findById($role->id);

        $data = PermissionGroup::with(['permissions' => function ($query) {
            $query->orderBy('name', 'ASC');
        }]);

        return view('admin.role.edit', compact('data', 'role'));
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'desc' => $request->desc,
                'guard_name' => $request->guard_name,
            ]);
            DB::commit();

            return $this->success(config('language.alert-success.store'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->error(config('language.alert-error.store').$th, 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $role = Role::find($id);
            $role->update([
                'name' => $request->name,
                'desc' => $request->desc,
                'slug' => $request->slug,
                'guard_name' => $request->guard_name,
            ]);
            $role->syncPermissions($request->permissions);
            DB::commit();

            return redirect()->back()->with('success', __('trans.crud.success'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', __('trans.crud.error'));
        }
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();

            return redirect()->back()->with('success', __('trans.crud.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('trans.crud.error'));
        }
    }
}

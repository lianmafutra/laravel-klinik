<?php

namespace App\Http\Controllers\Admin;

use App\Models\PermissionGroup;
use App\Utils\ApiResponse;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;

class PermissionGroupController extends Controller
{
    use ApiResponse;

    public function index()
    {

        $data = PermissionGroup::with(['permissions' => function ($query) {
            $query->orderBy('name', 'ASC');
        }]);

        if (request()->ajax()) {
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('admin.permissions-group.action', compact('data'));
                })
                ->editColumn('created_at', function ($data) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d/m/Y H:i:s');
                })
                ->editColumn('permissions', function ($data) {
                    $output = array_map(function ($val) {
                        return '<button type="button" class="m-1 btn bnt-sm btn-outline-secondary">'.$val.'</button>';
                    }, $data->permissions->pluck('name')->toArray());

                    return implode('', $output);
                })
                ->rawColumns(['action', 'permissions'])
                ->make(true);
        }

        return view('admin.permissions-group.index');
    }

    public function store(Request $request)
    {
        try {
            $permissionGroup = PermissionGroup::updateOrCreate(
                ['id' => $request->permission_group_id],
                $request->except('permission_group_id')
            );

            return $this->success(config('language.alert-success.store'));
        } catch (\Throwable $th) {
            return $this->error(config('language.alert-error.store').$th, 400);
        }
    }

    public function destroy(PermissionGroup $permissionGroup, Request $request)
    {
        try {
            DB::beginTransaction();
            $permissionGroup->delete();
            $permissionArray = Permission::where('permission_group_id', $permissionGroup->id)->get();

            // check if delete group, move all permission in ungroup
            if ($request->ungroup == 'true') {
                foreach ($permissionArray as $key => $value) {
                    Permission::where('id', $value->id)->update([
                        'permission_group_id' => 29,
                    ]);
                }
            } else {
                foreach ($permissionArray as $key => $value) {
                    Permission::where('id', $value->id)->delete();
                }
            }

            DB::commit();

            return $this->success(config('language.alert-success.destroy'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->error(config('language.alert-error.destroy').$th, 400);
        }
    }
}

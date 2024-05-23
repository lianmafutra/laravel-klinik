<?php

namespace App\Http\Controllers\Admin;

// use App\Models\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EventAuditServices;
use App\Services\Permissions\PermissionsGate;
use App\Utils\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    use ApiResponse;

    public function __construct(PermissionsGate $permissionsGate)
    {
        $permissionsGate->check('dashboard', $this, [
            [
                'name' => 'dashboard-app',
                'function' => 'index',
            ],
        ]);
    }

    public function index(Request $request)
    {

        $x['title'] = 'Dashboard';
        $x['totalUser'] = User::count();
        $x['totalRole'] = Role::count();
        $x['totalPermission'] = ModelsPermission::count();

        return view('admin.dashboard', $x);
    }

    public function getAuditLog()
    {
      //   $data = Audit::latest('id')->get();

      //   $data = $data->map(function ($item, $key) {

      //       return [
      //           'username' => $item->username,
      //           'event' => EventAuditServices::getEventColor($item->event),
      //           'auditable_type' => $item->auditable_type,
      //           'url' => $item->url,
      //           'created_at' => Carbon::parse($item?->created_at)?->format('d-m-Y H:i:s'),
      //       ];
      //   });

      //   return $this->success('Data Audit Log', $data);
    }
}

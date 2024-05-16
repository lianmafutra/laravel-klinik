<?php

namespace App\Http\Controllers\klinik\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboarddController extends Controller
{
   public function index()
   {
   
      return view('app.dashboard.index');
   }
}

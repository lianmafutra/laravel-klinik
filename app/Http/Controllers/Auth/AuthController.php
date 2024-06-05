<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function ubahPassword(Request $request)
   {
      try {

         $user = User::find(auth()->user()->id);
         if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Password Lama Tidak Cocok');
         }

         $user->password = bcrypt($request->password_baru);
         $user->save();

         return redirect()->back()->with('success', 'Berhasil Merubah Password');
      } catch (\Throwable $th) {
      

         return redirect()->back()->with('error', 'Gagal Merubah Password User');
      }
   }

   public function logout(Request $request)
   {
      Auth::logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      return redirect('/login');
   }
}

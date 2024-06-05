<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{


   public function showLoginForm(Request $request){
      if(auth()->user()){
         return to_route('klinik.dashboard.index');
      }else{
         $request->session()->regenerate();
         return view('auth.login');
      }
   
   }

   public function login(Request $request)
   {


      $credentials = $request->validate([
         'username' => 'required',
         'password' => 'required',
      ]);
      if (Auth::attempt($credentials, true)) {

         $request->session()->regenerate();
         if (auth()->user()->getRoleName() == 'superadmin') {
            return to_route('dashboard');
         } else {
            if (auth()->user()->status == 'NONAKTIF') {
               Auth::logout();
               throw ValidationException::withMessages([
                  $this->username() => ['User Di Nonaktifkan, Silahkan hubungi Admin'],
               ]);
            } else {
               if (auth()->user()->getRoleName() == 'superadmin') {
                  return to_route('dashboard');
               } else {
                  return to_route('klinik.dashboard.index');
               }
            }
         }
      }
      return back()->withErrors([
        "error" =>  [trans('Username atau Password Salah, Silahkan Coba Lagi')],
      ]);



      // if (Auth::attempt($credentials, false)) {

      //    if (auth()->user()->getRoleName() == 'superadmin') {
      //       return to_route('dashboard');
      //    } else {
      //       if (auth()->user()->status == 'NONAKTIF') {
      //          Auth::logout();
      //          throw ValidationException::withMessages([
      //             $this->username() => ['User Di Nonaktifkan, Silahkan hubungi Admin'],
      //          ]);
      //       } else {
      //          if (auth()->user()->getRoleName() == 'superadmin') {
      //             return to_route('dashboard');
      //          } else {
      //             return to_route('klinik.dashboard.index');
      //          }
      //       }
      //    }
      // }
      // throw ValidationException::withMessages([
      //    $this->username() => [trans('Username atau Password Salah, Silahkan Coba Lagi')],
      // ]);
   }
}

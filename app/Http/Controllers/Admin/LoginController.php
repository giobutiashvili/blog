<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\Admin;

class LoginController extends Controller
{
    public function showLogin(Request $request)
    {
        return $request->session()->has('admin') ?
         redirect()->route('AdminMainPage') : view('admin.login');
    }

    public function login (Request $request)
    {
        $this->validate($request, [
            'password'=> 'required',
            'email'=> 'required|email'
        ]);

        // ვიპოვოთ ადმინისტრატორი მითითებული ელ-ფოსტით
        $admin = Admin::where('email', $request->email)->first();

         // თუ ადმინისტრატრორი ვერ მოიძებნა ან მოიძებნა, მაგრამ არ ემთხვევა პაროლი
         if(!$admin || ($admin && !Hash::check($request->password, $admin->password)))
         {
            return redirect()->back()->with('login_failed', true);
         }

         // შევინახოთ ადმინისტრატორის მოდელი სესიაში
         $request->session()->put('admin', $admin);

         return redirect()->route('AdminMainPage');
    }
    public function logout (Request $request){
        $request->session()->forget('admin');
        return redirect()->route('ShowLogin');
    }

}

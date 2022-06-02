<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Support\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Socialite;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth/login');
    }
    /**
     * Redirecciona al usuario a la página de Facebook para autenticarse
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtiene la información de Facebook
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderFacebookCallback()
    {
        $auth_user = Socialite::driver('facebook')->user(); // Fetch authenticated user
        return redirect("/menu");
    }   
    public function logout(request $request)
    {
        Auth::logout();
        $request -> session()-> invalidate();
        $request->session ()->regenerateToken();
        return redirect("login")->with(Auth::logout());
    

        // try {
            /*/code...
         /   $auth_user = Socialite::driver('facebook')->user(); // Fetch authenticated user
            dd($auth_user);
            return redirect("/menu");
        } catch (Exception $e) {
            dd($e -> getMessage());
        }*/
    }

    /*public function showViewTest(){
        return view('auth/welcome');
    }
    */
   
}
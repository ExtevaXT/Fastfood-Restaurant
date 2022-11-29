<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegisterValidation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Open login page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function login()
    {
        return view('users.login');
    }
    /**
     * Authorize user
     * @param LoginValidation $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function loginPost(LoginValidation $request)
    {
        if(Auth::attempt($request->validated())){
            $request->session()->regenerate();
            return redirect()->route('about');
        }
        return back()->with(['auth'=>false]);
    }
    /**
     * Open register page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function register()
    {
        return view('users.register');
    }

    /**
     * Create user
     * @param RegisterValidation $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function registerPost(RegisterValidation $request)
    {
        $validation = $request->validated();
        $validation['password'] = Hash::make($validation['password']);

        User::create($validation);
        return redirect()->route('login')->with(['register'=> true]);
    }

    /**
     * User logout
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('about');
    }

}

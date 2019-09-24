<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            $users = User::all()->map(function ($user){
                $roles = $user->roles;
                $user->role = $roles->first();
                return $user;
            });
//            dd($users);
            $roles = Role::all();
            if ($user) {
                return view('settings.index', compact('users', 'roles'))->withUser($user);
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Category;
use App\Syscategory;
use App\User;
use App\Currency;
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
            $users = User::all()->map(function ($user) {
                $roles = $user->roles;
                $user->role = $roles->first();
                return $user;
            });
            $roles = Role::all();
            $currencies = Currency::all();
            $syscategories = Syscategory::all();
            $categories = Category::all()->each(function ($item) {
                if (!$item->parent_id) {
                    $item->_showDetails = true;
                } else {
                    $item->isCollapsed = false;
                }
            });
            $timezone_select = \Camroncade\Timezone\Facades\Timezone::selectForm(
                $user->timezone,
                '',
                ['class' => 'form-control', 'name' => 'timezone']
            );
            if ($user) {
                return view('settings.index', compact(
                    'users',
                    'roles',
                    'currencies',
                    'syscategories',
                    'categories',
                    'timezone_select'
                ))->withUser($user);
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
}

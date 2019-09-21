<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(EditUserRequest $request)
    {
        $user = User::find(Auth::user()->id);
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->operations = $request->operations;
            $user->day_start = $request->day_start;
            $user->receive_notify = $request->receive_notify;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'User profile has been updated',
                ]);
            }
            return redirect()->route('settings.index', $user)->with('success', 'Your profile has been updated');

        } else {
            abort(401, 'You are not authorized to do this action');
        }

    }
}

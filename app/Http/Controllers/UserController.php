<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateNotifyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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

    public function updateUser(UpdateUserRequest $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->is_active || $request->is_active > 0) {
                $isActive = '1';
            } else {
                $isActive = '0';
            }
            $user->is_active = $isActive;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            $user->syncRoles(Role::findById($request->role['id']));
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

    public function destroy(string $id)
    {
        if (Auth::user() && Auth::user()->hasPermissionTo('manage users')) {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json([
                'message' => 'User profile has been deleted',
            ]);
        } else {
            abort(403, 'You are not authorized to do this action');
        }
    }

    public function updateNotify(UpdateNotifyRequest $request)
    {
        $user = User::find(Auth::user()->id);
        if ($user) {
            $user->phone = $request->phone;
            $user->timezone = $request->timezone;
            if ($request->byEmail == 'on') {
                $user->notify_way = 'sms';
                $user->notify_frequency = $request->emailFrequency;
                $user->notify_hours = $request->emailHours;
                $user->notify_minutes = $request->emailMinutes;
            }
            if ($request->bySms == 'on') {
                $user->notify_way = 'email';
                $user->notify_frequency_sms = $request->smsFrequency;
                $user->notify_hours_sms = $request->smsHours;
                $user->notify_minutes_sms = $request->smsMinutes;
            }
            if ($request->bySms == 'on' && $request->byEmail == 'on') {
                $user->notify_way = 'all';
            }
            $user->save();
            return redirect()->route('settings.index', $user)->with('success', 'Your profile has been updated');
        } else {
            abort(401, 'You are not authorized to do this action');
        }
    }
}

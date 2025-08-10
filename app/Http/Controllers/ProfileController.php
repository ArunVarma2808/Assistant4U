<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view("profile.index", compact("settings"));
    }

    public function update_profile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => ['required', 'numeric', 'digits:10', Rule::unique('users', 'phone')->ignore(auth()->id())],
        ]);
        auth()->user()->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
        ], [
            'id' => auth()->id(),
        ]);
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\AvailableJob;
use App\Models\Province;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserJob;
use App\Models\UserJobLocation;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use Str;

class AuthController extends Controller
{
    public function signin_page(Request $request)
    {
        if (Auth::check()) {
            return $this->redirect_based_on_role();
        }
        $title = 'Sign In';
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('auth.signin', compact('title', 'settings'));
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && !$user->is_active) {
            return back()
                ->withErrors(['email' => 'Your account is temporarily suspended.'])
                ->withInput($request->only('email'));
        }

        if ($user && Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return $this->redirect_based_on_role();
        }

        return back()
            ->withErrors(['email' => 'Invalid credentials.'])
            ->withInput($request->only('email'));;
    }

    public function signup_page(Request $request)
    {
        if (Auth::check()) {
            return $this->redirect_based_on_role();
        }
        $settings = Setting::pluck('value', 'key')->toArray();
        if ($request->route()->getName() == 'signup-page-staff') {
            $title = 'Staff Portal';
            $jobs = AvailableJob::where('is_active', 1)->get();
            $provinces = Province::orderBy('name', 'asc')->get();
            return view('auth.signup-staff', compact('title', 'jobs', 'provinces', 'settings'));
        }
        $title = 'Customer Portal';
        return view('auth.signup', compact('title','settings'));
    }

    public function signup_staff(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric|digits:10|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'job_id' => 'required|exists:available_jobs,id',
            'license' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'service_charge' => 'required|numeric',
            'province_id' => 'required|exists:provinces,id',
            'region_id' => 'required|exists:regions,id',
        ], [
            'job_id.required' => 'The job field is required',
            'job_id.exists' => 'This job is unavailable',
            'province_id.required' => 'The province field is required',
            'province_id.exists' => 'This province is unavailable',
            'region_id.required' => 'The region field is required',
            'region_id.exists' => 'This region is unavailable',
        ]);
        
        $licensePath = null;
        if ($request->hasFile('license')) {
            $licensePath = $request->file('license')->store('job_license', 'public');
        }

        $user = User::create([
            'name' => ucwords($validated['name']),
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_subscribed' => true,
            'subscription_expires_at' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s'),
            'role' => 'staff',
        ]);

        UserJob::create([
            'user_id' => $user->id,
            'job_id' => $validated['job_id'],
            'license' => $licensePath,
            'service_charge' => $validated['service_charge'],
        ]);

        UserJobLocation::create([
            'user_id' => $user->id,
            'province_id' => $validated['province_id'],
            'region_id' => $validated['region_id'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return $this->redirect_based_on_role();
        }

        return redirect()->route('login')->with('error', 'Signup successful, but automatic login failed. Please login manually.');
    }

    public function signup_user(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric|digits:10|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);
        User::create([
            'name' => ucwords($request->name),
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return $this->redirect_based_on_role();
        }

        return redirect()->route('login')->with('error', 'Signup successful, but automatic login failed. Please login manually.');
    }

    public function redirect_based_on_role($message = NULL)
    {
        $role = Auth::user()->role;
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard')->with(['message' => $message]),
            'staff' => redirect()->route('staff.dashboard')->with(['message' => $message]),
            'user' => redirect()->route('user.dashboard')->with(['message' => $message]),
            default => abort(403, 'Unauthorized')
        };
    }

    public function signout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function forgot_password_page() {
        $title = 'Forgot Password';
        return view('auth.forgot-password', compact('title'));
    }

    public function forgotPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email not found']);
        }

        $newPassword = Str::random(10);

        $user->password = Hash::make($newPassword);
        $user->save();

        Mail::to($user->email)->send(new ForgotPasswordMail($user, $newPassword));

        return redirect()->route('signin-page')->with('success', 'A new password has been sent to your email address.');
    }
}

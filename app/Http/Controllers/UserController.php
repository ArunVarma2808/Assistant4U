<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function admin_dashboard()
    {
        $title = "Dashboard";
        $settings = Setting::pluck('value', 'key')->toArray();
        $count['customers'] = User::where('role', 'user')->where('is_active', 1)->count();
        $count['inactive_customers'] = User::where('role', 'user')->where('is_active', 0)->count();
        $count['staffs'] = User::where('role', 'staff')->where('is_active', 1)->count();
        $count['inactive_staffs'] = User::where('role', 'staff')->where('is_active', 0)->count();
        $count['pending_bookings'] = Booking::where('status', 'pending')->count();
        return view('dashboards.admin', compact('title', 'settings', 'count'));
    }

    public function staff_dashboard()
    {
        $title = "Dashboard";
        $settings = Setting::pluck('value', 'key')->toArray();
        $count['pending_bookings'] = Booking::where(['staff_id' => auth()->id(), 'status' => 'pending'])->count();
        $count['confirmed_bookings'] = Booking::where(['staff_id' => auth()->id(), 'status' => 'confirmed'])->count();
        $count['rejected_bookings'] = Booking::where(['staff_id' => auth()->id(), 'status' => 'rejected'])->count();
        $count['expired_bookings'] = Booking::where(['staff_id' => auth()->id(), 'status' => 'expired'])->count();
        $count['completed_bookings'] = Booking::where(['staff_id' => auth()->id(), 'status' => 'completed'])->count();
        $count['earnings'] = auth()->user()->balance;
        return view('dashboards.staff', compact('title', 'settings', 'count'));
    }

    public function user_dashboard()
    {
        $title = "Dashboard";
        $settings = Setting::pluck('value', 'key')->toArray();
        $count['pending_bookings'] = Booking::where(['customer_id' => auth()->id(), 'status' => 'pending'])->count();
        $count['confirmed_bookings'] = Booking::where(['customer_id' => auth()->id(), 'status' => 'confirmed'])->count();
        $count['rejected_bookings'] = Booking::where(['customer_id' => auth()->id(), 'status' => 'rejected'])->count();
        $count['cancelled_bookings'] = Booking::where(['customer_id' => auth()->id(), 'status' => 'cancelled'])->count();
        $count['expired_bookings'] = Booking::where(['customer_id' => auth()->id(), 'status' => 'expired'])->count();
        $count['completed_bookings'] = Booking::where(['customer_id' => auth()->id(), 'status' => 'completed'])->count();
        return view('dashboards.user', compact('title', 'settings', 'count'));
    }

    public function admin_manage_staffs()
    {
        $staffs = User::where('role', 'staff')->get();
        return view('users.manage_staff', compact('staffs'));
    }

    public function admin_manage_users()
    {
        $users = User::where('role', 'user')->get();
        return view('users.manage_user', compact('users'));
    }

    public function admin_update_user_status(Request $request)
    {
        $user = User::find($request->user_id);
        $user->is_active = $request->is_active == "true" ? 1 : 0;
        $user->save();
        
        return json_encode(['status' => 'success', 'message' => 'Status updated']);
    }

    public function renew_subscription(Request $request)
    {
        $user = Auth::user();
        $settings = Setting::pluck('value', 'key')->toArray();
        $user->is_subscribed = true;
        $user->subscription_expires_at = Carbon::now()->addDays((int) $settings['subscription_period'])->format('Y-m-d H:i:s');
        $user->save();

        Transaction::create([
            'user_id'=> $user->id,
            'amount' => $settings['subscription_amount'],
            'transaction_date'=> Carbon::now(),
        ]);

        $admin = User::find(1);
        $admin->update([
            'balance' => (int) $admin->balance + (int) $settings['subscription_amount']
        ]);

        return redirect()->back()->with('success', 'Subscription renewed');
    }
}

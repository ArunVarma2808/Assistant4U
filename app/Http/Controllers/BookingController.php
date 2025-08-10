<?php

namespace App\Http\Controllers;

use App\Mail\BookingStatusUpdatedMail;
use App\Models\AvailableJob;
use App\Models\Booking;
use App\Models\Province;
use App\Models\Region;
use App\Models\Setting;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Storage;
use Validator;

class BookingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        if (Auth::user()->role == "admin") {
            $bookings = Booking::latest()->get();
            return view("service_bookings.admin.index", compact("bookings", "settings"));
        } else if (Auth::user()->role == "staff") {
            $bookings = Booking::where("staff_id", Auth::user()->id)
                ->whereNot("status", "cancelled")
                ->latest()->get();
            return view("service_bookings.staff.index", compact("bookings", "settings"));
        } else {
            $bookings = Booking::where("customer_id", Auth::user()->id)->latest()->get();
            return view("service_bookings.user.index", compact("bookings", "settings"));
        }
    }

    public function view_booking(Booking $booking)
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('service_bookings.admin.modal.view', compact('booking', 'settings'));
    }

    public function search(Request $request)
    {
        $selected_service = $request->service;
        $selected_province = $request->province;
        $selected_region = $request->region;

        $services = AvailableJob::all();
        $provinces = Province::all();
        $regions = !empty($selected_province) ? Region::where('province_id', $selected_province)->get() : [];

        $users = User::where([
            'role' => 'staff',
            'is_subscribed' => true
        ])->whereHas('jobLocation', function ($query) use ($request) {
            if ($request->province) {
                $query->where('province_id', $request->province);
            }
            if ($request->region) {
                $query->where('region_id', $request->region);
            }
        })->whereHas('job', function ($query) use ($request) {
            if ($request->service) {
                $query->where('job_id', $request->service);
            }
        })->get();

        $settings = Setting::pluck('value', 'key')->toArray();
        return view('service_bookings.search', compact('services', 'provinces', 'regions', 'users', 'selected_service', 'selected_province', 'selected_region', 'settings'));
    }

    public function view_staff_service(Request $request, User $user)
    {
        return view('service_bookings.partials.view_job_profile', compact('user'));
    }

    public function book_staff_service(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i', // e.g., 14:30
            'address' => 'required|string|max:255',
            'message' => 'nullable|string',
            'staff_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => 'error', 'errors' => $validator->errors()]);
        }

        $validated = $validator->validated();

        $booking = Booking::create([
            'customer_id' => Auth::id(), // current logged-in user
            'staff_id' => $validated['staff_id'] ?? null,
            'booking_date' => $validated['booking_date'],
            'booking_time' => $validated['booking_time'],
            'address' => $validated['address'],
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
        ]);

        return json_encode(['status' => 'success', 'message' => 'Booking Added']);
    }

    public function staff_update_booking(Request $request, Booking $booking)
    {
        $newStatus = $request->status;
        $currentStatus = $booking->status;

        if (in_array($newStatus, ['confirmed', 'rejected'])) {
            if ($currentStatus !== 'pending') {
                return redirect()->back()->with([
                    'failure' => 'Only pending bookings can be confirmed or rejected.'
                ]);
            }
        } elseif ($newStatus === 'completed') {
            if ($currentStatus !== 'confirmed') {
                return redirect()->back()->with([
                    'failure' => 'Only confirmed bookings can be marked as completed.'
                ]);
            }
            if (!empty($request->amount_earned)) {
                $booking->earnings = $request->amount_earned;
                $user = auth()->user();
                $user->update([
                    'balance' => (int) $user->balance + (int) $request->amount_earned
                ]);
            }
        } else {
            return redirect()->back()->with([
                'failure' => 'Invalid booking status update.'
            ]);
        }

        $booking->status = $newStatus;
        $booking->save();

        try {
            Mail::to($booking->customer->email)->send(new BookingStatusUpdatedMail($booking));
        } catch (\Exception $e) {
            Log::error('Failed to send booking status update email: ' . $e->getMessage());
        }

        return redirect()->back()->with([
            'success' => 'Booking status updated successfully.'
        ]);
    }

    public function user_cancel_booking(Request $request, Booking $booking)
    {
        $booking->status = 'cancelled';
        $booking->update();
        return redirect()->back()->with(['success' => true, 'message' => 'Booking cancelled successfully']);
    }
}

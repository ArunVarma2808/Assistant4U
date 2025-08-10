<?php

namespace App\Http\Middleware;

use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateExpiredSubscriptions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        User::whereNotNull('subscription_expires_at')
            ->where('role', 'staff')
            ->where('subscription_expires_at', '<', Carbon::now())
            ->where('is_subscribed', true)
            ->update(['is_subscribed' => false]);

        $driver = DB::getDriverName();
        $now = Carbon::now()->format('Y-m-d H:i:s');

        if ($driver === 'mysql') {
            Booking::where('status', 'pending')
                ->where(DB::raw("CONCAT(booking_date, ' ', booking_time)"), '<=', $now)
                ->update([
                    'status' => 'expired',
                    'updated_at' => now(),
                ]);
        } elseif ($driver === 'sqlite') {
            Booking::where('status', 'pending')
                ->where(DB::raw("booking_date || ' ' || booking_time"), '<=', $now)
                ->update([
                    'status' => 'expired',
                    'updated_at' => now(),
                ]);
        }

        return $next($request);
    }
}

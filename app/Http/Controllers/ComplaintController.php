<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Setting;
use Auth;
use Carbon\Carbon;
use Faker\Provider\ar_EG\Company;
use Illuminate\Http\Request;
use Validator;

class ComplaintController extends Controller
{

    public function create(Request $request)
    {
        return view('complaints.user.create');
    }

    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        if (Auth::user()->role == "admin") {
            $complaints = Complaint::latest()->get();
            return view("complaints.admin.index", compact("complaints", "settings"));
        } else if (Auth::user()->role == "staff") {
            $complaints = Complaint::where("user_id", Auth::user()->id)->latest()->get();
            return view("complaints.user.index", compact("complaints", "settings"));
        } else {
            $complaints = Complaint::where("user_id", Auth::user()->id)->latest()->get();
            return view("complaints.user.index", compact("complaints", "settings"));
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|min:3',
        ], [
            'message.min' => 'Complaint message is too short'
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => 'error', 'errors' => $validator->errors()]);
        }

        Complaint::create([
            'user_id' => Auth::user()->id,
            'is_user' => Auth::user()->role == 'user',
            'is_staff' => Auth::user()->role == 'staff',
            'message' => $request->message,
            'messaged_on' => Carbon::now(),
        ]);

        return json_encode(['status' => 'success', 'message' => "Complaint Added Successfully"]);
    }

    public function show_reply_popup(Request $request, Complaint $complaint)
    {
        return view("complaints.partials.send_reply", compact("complaint"));
    }

    public function save_complaint_reply(Request $request, Complaint $complaint)
    {
        $validator = Validator::make($request->all(), [
            'reply' => 'required|string|min:3',
        ], [
            'reply.min' => 'Reply message is too short'
        ]);
        if ($validator->fails()) {
            return json_encode(['status' => 'error', 'errors' => $validator->errors()]);
        }

        $complaint->reply = $request->reply;
        $complaint->replied_on = Carbon::now();
        $complaint->save();
        
        return json_encode(['status' => 'success', 'message' => "Reply Sent Successfully"]);
    }
}

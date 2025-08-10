<?php

namespace App\Http\Controllers;

use App\Models\AvailableJob;
use App\Models\Province;
use App\Models\Region;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserJob;
use App\Models\UserJobLocation;
use Auth;
use Illuminate\Http\Request;
use Validator;

class JobServiceController extends Controller
{
    public function index() {
        $jobservices = AvailableJob::all();
        return view('jobservices.index', compact('jobservices'));
    }

    public function create()
    {
        return view('jobservices.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
        ], [
            'name.min' => 'Job service name is too short'
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => 'error', 'errors' => $validator->errors()]);
        }

        AvailableJob::create([
            'name' => $request->name,
        ]);

        return json_encode(['status' => 'success', 'message' => "Job Service Added Successfully"]);
    }

    public function delete(AvailableJob $jobservice) {
        $jobservice->delete();
        return json_encode(['status' => 'success', 'message' => "Job service deleted"]);
    }

    public function staff_update_job() {
        $settings = Setting::pluck('value', 'key')->toArray();
        $current_job = User::find(auth()->id())->job;
        $jobs = AvailableJob::where('is_active', 1)->get();
        $provinces = UserJobLocation::where('user_id', auth()->id())->get();
        $provinces = Province::all();
        $provinceIds = UserJobLocation::where('user_id', auth()->id())
            ->distinct()
            ->pluck('province_id')->toArray();
        return view("jobservices.staff_service_locations", compact("provinces", "provinceIds", "settings", "jobs", "current_job"));
    }

    public function save_job_update(Request $request) {
        $validated = $request->validate([
            'service_charge' => 'required|numeric',
        ]);

        $current_job = User::find(auth()->id())->job;

        $licensePath = null;
        if ($request->hasFile('license')) {
            $licensePath = $request->file('license')->store('job_license', 'public');
            $current_job->license = $licensePath;
        }
        $current_job->service_charge = $validated['service_charge'];
        $current_job->update();
        
        return redirect()->back()->with('success','Job details updated');
    }

    public function get_staff_regions(Request $request) {
        $province_ids = $request->province_ids;
        if (empty($province_ids)) {
            return response()->json(['status'=> 'success','provinces'=> []]);
        }
        $provinces = Province::whereIn('id', $province_ids)->get();
        
        $regionIds = UserJobLocation::where('user_id', auth()->id())
            ->distinct()
            ->pluck('region_id')->toArray();
        
        $provinceRegionMap = [];

        foreach ($provinces as $province) {
            $provinceRegionMap[$province->id]['id'] = $province->id;
            $provinceRegionMap[$province->id]['name'] = $province->name;
            $provinceRegionMap[$province->id]['regions'] = $province->regions->map(function ($region) use ($regionIds) {
                return [
                    'id' => $region->id,
                    'name' => $region->name,
                    'is_selected' => in_array($region->id, $regionIds),
                ];
            })->toArray();
        }

        return response()->json(['status'=> 'success','provinces'=> $provinceRegionMap]);
    }
    
    public function save_job_location_update(Request $request) {
        $validated = $request->validate([
            'provinces' => 'required|array|min:1',
            'provinces.*' => 'integer|exists:provinces,id',
            'regions' => 'required|array|min:1',
            'regions.*' => 'integer|exists:regions,id',
        ]);

        $regions = Region::whereIn('id', $validated['regions'])->get();

        UserJobLocation::where('user_id', auth()->id())->delete();
        foreach ($regions as $key => $region) {
            UserJobLocation::create([
                'user_id'=> auth()->id(),
                'province_id'=> $region->province_id,
                'region_id'=> $region->id,
            ]);
        }

        return redirect()->back()->with('success','Service locations updated');
    }

}

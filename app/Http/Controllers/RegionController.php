<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;
use Validator;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('regions.index', compact('regions'));
    }

    public function create()
    {
        $provinces = Province::all();
        return view('regions.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255|unique:regions,name',
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => 'error', 'errors' => $validator->errors()]);
        }

        Region::create([
            'province_id' => $request->province_id,
            'name' => $request->name,
        ]);

        return json_encode(['status' => 'success', 'message' => "Region Added Successfully"]);
    }

    public function edit(Region $region)
    {
        $provinces = Province::all();
        return view('regions.edit', compact('provinces', 'region'));
    }

    public function update(Request $request, Region $region)
    {
        $validator = Validator::make($request->all(), [
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255|unique:regions,name,' . $region->id,
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => 'error', 'errors' => $validator->errors()]);
        }

        $region->name = $request->name;
        $region->province_id = $request->province_id;
        $region->update();
        
        return json_encode(['status' => 'success', 'message' => "Region Updated Successfully"]);
    }

    public function delete(Region $region) {
        $region->delete();
        return redirect()->back()->with('success', 'Region deleted!');
    }
}

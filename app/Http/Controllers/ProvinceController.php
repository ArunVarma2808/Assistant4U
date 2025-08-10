<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        return view('provinces.index', compact('provinces'));
    }

    public function create()
    {
        return view('provinces.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => 'error', 'errors' => $validator->errors()]);
        }

        Province::create([
            'name' => $request->name,
        ]);

        return json_encode(['status' => 'success', 'message' => "Province Added Successfully"]);
    }

    public function edit(Province $province)
    {
        return view('provinces.edit', compact('province'));
    }

    public function update(Request $request, Province $province)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return json_encode(['status' => 'error', 'errors' => $validator->errors()]);
        }

        $province->name = $request->name;
        $province->update();
        
        return json_encode(['status' => 'success', 'message' => "Province Updated Successfully"]);
    }

    public function delete(Province $province) {
        $province->delete();
        return redirect()->back()->with('success', 'Province deleted!');
    }

    public function get_regions(Province $province) {
        $regions = $province->regions()->orderBy('name', 'asc')->get();
        return response()->json($regions);
    }
}

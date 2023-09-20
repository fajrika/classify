<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Hardware;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HardwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hardwares = Hardware::paginate(7);
        return view('pages.master.hardware.list', compact('hardwares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $plants = Plant::all();
        return view('pages.master.hardware.create', compact('plants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'plant' => 'required',
        ]);

        $hardware = new Hardware;
        $hardware->name = $request->name;
        $hardware->code = $request->code;
        $hardware->plant_id = $request->plant;
        $hardware->save();

        return back()->with('success', 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hardware $hardware)
    {
        $temp = $hardware->hardwareReports()->latest()->take(20)->pluck('temperature')->toArray();
        $humi = $hardware->hardwareReports()->latest()->take(20)->pluck('humidity')->toArray();
        $conclusion = $hardware->hardwareReports()->latest()->take(20)->pluck('conclusion')->toArray();
        $created_at = $hardware->hardwareReports()->latest()->take(20)->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') AS created_at_custom"))->pluck('created_at_custom')->toArray();

        $plant = $hardware->plant;
        return view('pages.master.hardware.show', compact("hardware", "temp", "humi", "created_at", "conclusion","plant"));
    }

    public function show_data(Hardware $hardware, $type)
    {
        if ($type == 'temperature')
            $report = $hardware->hardwareReports()->select("created_at as x", "temperature as y")->latest()->take(20)->get()->reverse()->values();
        else if ($type == 'humidity')
            $report = $hardware->hardwareReports()->select("created_at as x", "humidity as y")->latest()->take(20)->get()->reverse()->values();
        else
            $report = $hardware->hardwareReports()->select("created_at as x", "conclusion as y")->latest()->take(20)->get()->reverse()->values();
        return response()->json($report, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hardware $hardware)
    {
        $plants = Plant::all();
        return view('pages.master.hardware.edit', compact("hardware", "plants"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hardware $hardware)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'plant' => 'required',
        ]);

        $hardware->name = $request->name;
        $hardware->code = $request->code;
        $hardware->plant_id = $request->plant;
        $hardware->save();

        return back()->with('success', 'Berhasil merubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hardware $hardware)
    {
        $hardware->delete();
        return back()->with('success', 'Berhasil menghapus data!');
    }
}

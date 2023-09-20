<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Hardware;
use App\Models\HardwareReport;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HardwareReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.data.hardware.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('a');
        $k = 3;
        $validator = Validator::make($request->all(), [
            'temp' => 'required|numeric',
            'humi' => 'required|numeric',
            'token' => 'required|exists:hardware,code',
        ]);
        $request->temp = (int)$request->temp;
        $request->humi = (int)$request->humi;
        
        if ($validator->fails()) {
            return response()->json($validator->messages(), 500);
        }
        $hardware = Hardware::where('code', $request->token)->first();
        $plant = $hardware->plant()->first();
        $plantDataTrainings = $plant->plantDataTrainings()->select('temperature', 'humidity', 'conclusion')->get();
        $distances = [];
        foreach ($plantDataTrainings as $key => $plantDataTraining) {
            // https://pub.towardsai.net/k-nearest-neighbors-knn-algorithm-tutorial-machine-learning-basics-ml-ec6756d3e0ac
            $plantDataTrainings[$key]->distance
                = sqrt(pow($request->humi - $plantDataTraining->humidity, 2))
                + sqrt(pow($request->temp - $plantDataTraining->temperature, 2));
            array_push($distances, $plantDataTrainings[$key]->distance);
        }
        asort($distances);
        // get $k nearest distanes
        $nearest = [];
        $positive = 0;
        $negative = 0;
        $i = 0;
        foreach ($distances as $key => $value) {
            if ($i++ < $k) {
                array_push($nearest, $plantDataTrainings[$key]->toArray());
                if ($plantDataTrainings[$key]->conclusion == 1)
                    $positive++;
                else
                    $negative++;
            } else
                break;
        }

        if ($positive < $negative)
            $conclusion = 0;
        else
            $conclusion = 1;

        $hardwareReport = new HardwareReport();
        $hardwareReport->hardware_id = $hardware->id;
        $hardwareReport->temperature = $request->temp;
        $hardwareReport->humidity = $request->humi;
        $hardwareReport->conclusion = $conclusion;
        $hardwareReport->save();
        return response()->json($hardwareReport, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(HardwareReport $hardwareReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HardwareReport $hardwareReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HardwareReport $hardwareReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HardwareReport $hardwareReport)
    {
        //
    }
}

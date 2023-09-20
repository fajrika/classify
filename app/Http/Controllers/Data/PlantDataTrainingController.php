<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\PlantDataTraining;
use Illuminate\Http\Request;

class PlantDataTrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plants = Plant::withCount(['hardwares', 'plantDataTrainings'])->paginate(7);
        return view('pages.data.plant.list', compact("plants"));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant)
    {
        $positive = $plant->plantDataTrainings()->where('conclusion', 1)->get()->map(function ($model) {
            return [$model->humidity, $model->temperature];
        })->toArray();
        $negative = $plant->plantDataTrainings()->where('conclusion', 0)->get()->map(function ($model) {
            return [$model->humidity, $model->temperature];
        })->toArray();

        $tempMin = $plant->plantDataTrainings()->where('conclusion', 0)->min('temperature') - 2;
        $tempMax = $plant->plantDataTrainings()->where('conclusion', 0)->max('temperature') + 2;

        $humiMin = $plant->plantDataTrainings()->where('conclusion', 0)->min('humidity') - 10;
        $humiMax = $plant->plantDataTrainings()->where('conclusion', 0)->max('humidity') + 10;

        return view('pages.data.plant.show', compact("plant", "positive", "negative", "tempMin", "tempMax", "humiMin", "humiMax"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlantDataTraining $plantDataTraining)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function generate(Plant $plant)
    {
        return view('pages.data.plant.generate', compact("plant"));
    }

    public function updateGenerate(Request $request, Plant $plant)
    {
        $request->validate([
            "rangeTemperatureMin" => "required|numeric",
            "rangeTemperatureMax" => "required|numeric",
            "rangeHumidityMin" => "required|numeric",
            "rangeHumidityMax" => "required|numeric",
            "dataType" => "required|numeric",
            "dataTemperatureMin" => "required|numeric",
            "dataTemperatureMax" => "required|numeric",
            "dataHumidityMin" => "required|numeric",
            "dataHumidityMax" => "required|numeric",
        ]);
        $dataType = (int)$request->dataType;
        if ($dataType == 1)
            $dataTypeInvert = 0;
        else
            $dataTypeInvert = 1;


        // delete semua data di plant tsb
        $plant->plantDataTrainings()->delete();

        for ($temp = (int)$request->rangeTemperatureMin; $temp <= $request->rangeTemperatureMax; $temp++) {
            for ($humi = (int)$request->rangeHumidityMin; $humi <= $request->rangeHumidityMax; $humi++) {
                if (
                    $temp >= $request->dataTemperatureMin && $temp <= $request->dataTemperatureMax
                    && $humi >= $request->dataHumidityMin && $humi <= $request->dataHumidityMax
                )
                    $conclusion = $dataType;
                else
                    $conclusion = $dataTypeInvert;


                $plant->plantDataTrainings()->create([
                    'temperature' => $temp,
                    'humidity' => $humi,
                    'conclusion' => $conclusion
                ]);
            }
        }
        return back()->with('success', 'Berhasil generate data!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function manual(Plant $plant)
    {
        return view('pages.data.plant.manual', compact("plant"));
    }
    public function updateManual(Request $request, Plant $plant)
    {

        $request->validate([
            "fileCsv" => "required|file|mimes:csv",
        ]);

        $plant->plantDataTrainings()->delete();

        $row = 1;
        $csv = fopen($request->fileCsv, "r");
        while (($data = fgetcsv($csv, 1000, ",")) !== FALSE) {
            $plant->plantDataTrainings()->create([
                'temperature' => $data[0],
                'humidity' => $data[1],
                'conclusion' => $data[2]
            ]);
        }
        fclose($csv);
        return back()->with('success', 'Berhasil update data manual!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlantDataTraining $plantDataTraining)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlantDataTraining $plantDataTraining)
    {
        //
    }
}

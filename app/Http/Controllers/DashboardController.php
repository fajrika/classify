<?php

namespace App\Http\Controllers;

use App\Models\PlantDataTraining;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $plant_data_training = (object)[
            "count" => PlantDataTraining::count(),
            "positive_count" => PlantDataTraining::where('conclusion', 1)->count(),
            "negative_count" => PlantDataTraining::where('conclusion', 0)->count()
        ];
        return view('pages.dashboard', compact('plant_data_training'));
    }
}

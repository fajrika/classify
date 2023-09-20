<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plants = Plant::withCount('hardwares')->paginate(7);
        return view('pages.master.plant.list', compact('plants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master.plant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'latin' => 'required',
        ]);

        $plant = new Plant;
        $plant->name = $request->name;
        $plant->latin = $request->latin;
        $plant->save();

        return back()->with('success', 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plant $plant)
    {
        return view('pages.master.plant.edit', compact("plant"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plant $plant)
    {
        $request->validate([
            'name' => 'required',
            'latin' => 'required',
        ]);

        $plant->name = $request->name;
        $plant->latin = $request->latin;
        $plant->save();

        return back()->with('success', 'Berhasil merubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant)
    {
        $plant->delete();
        return back()->with('success', 'Berhasil menghapus data!');
    }
}

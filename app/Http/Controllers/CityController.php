<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate(['country_id' => 'required']);

        // Return cities based on country_id
        return City::where('country_id', $request->country_id)->get();
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
        $request->validate([
            'name' => 'required|unique:cities,name,NULL,id,country_id,' . $request->country_id,
            'country_id' => 'required|exists:countries,id',
        ]);

        $city = City::create($request->only('name', 'country_id'));

        return response()->json($city, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getCitiesByCountry($countryId)
    {
        $cities = City::where('country_id', $countryId)->get();
        return response()->json($cities);
    }
}

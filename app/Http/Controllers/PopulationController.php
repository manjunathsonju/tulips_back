<?php

namespace App\Http\Controllers;

use App\Models\Population;
use Illuminate\Http\Request;

class PopulationController extends Controller
{

    public function index(Request $request)
    {
        $query = Population::query();

        // Filter by country_id if provided
        if ($request->has('country_id') && $request->country_id != '') {
            $query->where('country_id', $request->country_id);
        }

        // Filter by city_id if provided
        if ($request->has('city_id') && $request->city_id != '') {
            $query->where('city_id', $request->city_id);
        }

        // Filter by age group if provided
        if ($request->has('age_group') && $request->age_group != '') {
            $query->where('age_group', $request->age_group);
        }

        // Filter by male population if provided
        if ($request->has('male_population') && $request->male_population != '') {
            $query->where('male_population', '>=', $request->male_population);
        }

        // Filter by female population if provided
        if ($request->has('female_population') && $request->female_population != '') {
            $query->where('female_population', '>=', $request->female_population);
        }

        $populations = $query->with('country')->with('city')->get();

        return response()->json($populations);
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'age_group' => 'required',
            'male_population' => 'required|numeric',
            'female_population' => 'required|numeric'
        ]);

        $population = Population::create($request->only('country_id', 'city_id', 'age_group', 'male_population', 'female_population'));

        return response()->json(['message' => 'Population data saved successfully!'], 201);
    }
}

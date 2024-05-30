<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::orderByDesc('id')->paginate(5);
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($request->name, '-');

        $tech = Technology::create($val_data);

        if ($request->has('projects')) {
            $tech->projects()->attach($val_data['projects']);
        }

        return to_route('admin.technologies.index')->with('message', 'Technology created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->name, '-');

        $technology->update($val_data);

        if ($request->has('projects')) {
            $technology->projects()->sync($val_data['projects']);
        } else {
            $technology->projects()->detach();
        }

        return to_route('admin.technologies.index', $technology)->with('message', "Project $technology->name updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->projects()->detach();
        $technology->delete();

        return to_route('admin.technologies.index')->with('message', 'Technology deleted successfully');
    }
}

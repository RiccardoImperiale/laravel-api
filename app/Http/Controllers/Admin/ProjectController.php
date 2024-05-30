<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.projects.index', ['projects' => Project::orderByDesc('id')->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->title, '-');
        $val_data['image'] = Storage::put('uploads', $request->image);

        $project = Project::create($val_data);

        if ($request->has('technologies')) {
            $project->technologies()->attach($val_data['technologies']);
        }

        return to_route('admin.projects.index')->with('message', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->title, '-');

        if ($request->has('image')) {
            if ($project->image) {
                Storage::delete($project->image);
            }

            $val_data['image'] = Storage::put('uploads', $request->image);
        }

        $project->update($val_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($val_data['technologies']);
        } else {
            $project->technologies()->detach();
        }

        return to_route('admin.projects.index', $project)->with('message', "Project $project->title updated successfully");
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::delete($project->image);
        }

        $project->technologies()->detach();

        $project->delete();
        return to_route('admin.projects.index')->with('message', 'Project deleted successfully');
    }
}

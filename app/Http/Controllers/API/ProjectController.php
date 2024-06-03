<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('type', 'technologies')->orderByDesc('id')->paginate(6);

        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }

    public function featured()
    {
        $ids = [41, 40, 39, 38, 37, 31];
        $projects = Project::with('type', 'technologies')->whereIn('id', $ids)->get();
        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }

    public function show($slug)
    {
        $project = Project::with('type', 'technologies')->where('slug', $slug)->first();

        if ($project) {
            return response()->json([
                'success' => true,
                'response' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'response' => '404 sorry nothing found!'
            ]);
        }
    }
}

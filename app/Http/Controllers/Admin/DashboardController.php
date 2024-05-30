<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(5);
        $types = Type::orderByDesc('id')->paginate(5);
        $technologies = Technology::orderByDesc('id')->paginate(5);
        return view('admin.dashboard', compact('projects', 'types', 'technologies'));
    }
}

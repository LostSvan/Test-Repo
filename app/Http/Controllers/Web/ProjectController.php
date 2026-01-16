<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index(Request $request)
    {
        $projects = $this->projectService->getAllProjects($request->search);
        return view('projects.index', compact('projects'));
    }

    public function show($id)
    {
        $project = Project::with(['tasks.assignedUser'])->findOrFail($id);
        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $this->projectService->createProject($request->validated(), auth()->id());
        return redirect()->route('projects.index');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    public function update(StoreProjectRequest $request, Project $project)
    {
        $this->projectService->updateProject($project, $request->validated());
        return redirect()->route('projects.index')->with('success', 'Project updated!');
    }

    public function destroy(Project $project)
    {
        $this->projectService->deleteProject($project);
        return redirect()->route('projects.index')->with('success', 'Project deleted!');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
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
        return response()->json([
            'message' => 'Projects received successfully',
            'projects' => $projects
        ]);
    }

    public function store(StoreProjectRequest $request)
    {
        $project = $this->projectService->createProject($request->validated(), auth()->id());
        return response()->json([
            'message' => 'Project was created',
            'project' => $project
        ], 201);
    }

    public function update(StoreProjectRequest $request, Project $project)
    {
        $updatedProject = $this->projectService->updateProject($project, $request->validated());
        return response()->json([
            'message' => 'Project updated successfully',
            'project' => $updatedProject
        ]);
    }

    public function destroy(Project $project)
    {
        $this->projectService->deleteProject($project);
        return response()->json(['message' => 'Project deleted successfully']);
    }
}

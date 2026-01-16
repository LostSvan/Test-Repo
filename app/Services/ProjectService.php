<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    public function getAllProjects($search = null)
    {
        $query = Project::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return $query->latest()->get();
    }

    public function createProject($data, $userId)
    {
        return Project::create(array_merge($data, ['user_id' => $userId]));
    }

    public function updateProject(Project $project, $data)
    {
        $project->update($data);
        return $project;
    }

    public function deleteProject(Project $project)
    {
        return $project->delete();
    }
}

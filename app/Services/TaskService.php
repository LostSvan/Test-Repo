<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function getAllTasks($search = null)
    {
        $query = Task::with(['project', 'assignedUser']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return $query->latest()->get();
    }

    public function createTask($data)
    {
        return Task::create($data);
    }

    public function updateTask(Task $task, $data)
    {
        $task->update($data);
        return $task->load(['project', 'assignedUser']);
    }

    public function deleteTask(Task $task)
    {
        return $task->delete();
    }
}

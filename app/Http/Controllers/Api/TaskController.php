<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->getAllTasks($request->search);

        return response()->json([
            'message' => 'Tasks received successfully',
            'tasks' => $tasks
        ]);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->createTask($request->validated());

        return response()->json([
            'message' => 'Task created successfully',
            'task'    => $task->load(['project', 'assignedUser'])
        ], 201);
    }

    public function show(Task $task)
    {
        return response()->json($task->load(['project', 'assignedUser']));
    }

    public function update(StoreTaskRequest $request, Task $task)
    {
        $updatedTask = $this->taskService->updateTask($task, $request->validated());

        return response()->json([
            'message' => 'Task updated successfully',
            'task'    => $updatedTask
        ]);
    }

    public function destroy(Task $task)
    {
        $this->taskService->deleteTask($task);
        return response()->json(['message' => 'Task deleted successfully']);
    }
}

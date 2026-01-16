<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTaskRequest;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use App\Services\TaskService;
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
        return view('tasks.index', compact('tasks'));
    }

    public function show($id)
    {
        $task = Task::with(['project', 'assignedUser'])->findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    public function create()
    {
        $projects = Project::all();
        $users = User::all();
        return view('tasks.create', compact('projects', 'users'));
    }

    public function store(StoreTaskRequest $request)
    {
        $this->taskService->createTask($request->validated());
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $projects = Project::all();
        $users = User::all();
        return view('tasks.edit', compact('task', 'projects', 'users'));
    }

    public function update(StoreTaskRequest $request, Task $task)
    {
        $this->taskService->updateTask($task, $request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task updated!');
    }

    public function destroy(Task $task)
    {
        $this->taskService->deleteTask($task);
        return redirect()->route('tasks.index')->with('success', 'Task deleted!');
    }
}

@extends('layouts.admin-layout')

@section('content')
    <div class="card border-all mt-5">
        <div class="card-header d-flex justify-content-between align-items-center border-bottom-custom">
            <h3>Project: {{ $project->title }}</h3>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary btn-sm">Back to Projects</a>
        </div>
        <div class="card-body">
            <div class="mb-4 border-bottom-custom">
                <h5>Description</h5>
                <p>{{ $project->description }}</p>
            </div>

            <h5 class="mb-3">Project Tasks</h5>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Performer</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($project->tasks as $task)
                    <tr class="border-all">
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->assignedUser->name ?? '---' }}</td>
                        <td>
                            <span class="badge bg-dark">{{ $task->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-dark btn-sm">Details</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No tasks assigned to this project yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

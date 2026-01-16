@extends('layouts.admin-layout')

@section('content')
    <div class="card border-all mt-5">
        <div class="card-header border-bottom-custom">
            <h3>Edit Task: {{ $task->title }}</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control border-all" value="{{ old('title', $task->title) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Project</label>
                    <select name="project_id" class="form-select border-all">
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                                {{ $project->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Assigned User</label>
                    <select name="assigned_id" class="form-select border-all">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('assigned_id', $task->assigned_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select border-all">
                        @foreach(['todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Done'] as $value => $label)
                            <option value="{{ $value }}" {{ old('status', $task->status) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control border-all" rows="3">{{ old('description', $task->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-dark">Update Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection

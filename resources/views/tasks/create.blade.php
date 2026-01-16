@extends('layouts.admin-layout')

@section('content')
    <div class="card border-all mt-5">
        <div class="card-header border-bottom-custom">
            <h3>Create Task</h3>
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
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" placeholder="Enter title" class="form-control border-all">
                </div>
                <div class="mb-3">
                    <label class="form-label">Project</label>
                    <select name="project_id" class="form-select border-all">
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Assigned User</label>
                    <select name="assigned_id" class="form-select border-all">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select border-all">
                        <option value="todo">To Do</option>
                        <option value="in_progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control border-all" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-dark">Create Task</button>
            </form>
        </div>
    </div>
@endsection

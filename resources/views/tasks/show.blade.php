@extends('layouts.admin-layout')

@section('content')
    <div class="container mt-5">
        <div class="card border-all">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom-custom">
                <h3>Task Details: {{ $task->title }}</h3>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Project:</div>
                    <div class="col-md-9">{{ $task->project->title }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Description:</div>
                    <div class="col-md-9">{{ $task->description ?? 'No description provided.' }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Assigned User:</div>
                    <div class="col-md-9">{{ $task->assignedUser->name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Status:</div>
                    <div class="col-md-9">
                        <span class="badge bg-dark">{{ strtoupper($task->status) }}</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Created At:</div>
                    <div class="col-md-9">{{ $task->created_at->format('d.m.Y H:i') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin-layout')

@section('content')
    <div class="card border-all mt-5">
        <div class="card-header d-flex justify-content-between align-items-center border-bottom-custom">
            <h3>Tasks</h3>

            <form action="{{ route('tasks.index') }}" method="GET" class="d-flex w-25">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control border-all"
                       placeholder="Search...">
                <button type="submit" class="btn btn-dark ms-2">Find</button>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Project</th>
                    <th>Performer</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tasks as $task)
                    <tr class="border-all">
                        <td>{{ $task->title }}</td>
                        <td>
                            @if($task->project)
                                <a href="{{ route('projects.index', ['search' => $task->project->title]) }}">
                                    {{ $task->project->title }}
                                </a>
                            @else
                                ---
                            @endif
                        </td>
                        <td>{{ $task->assignedUser->name }}</td>
                        <td>
                            <span class="badge bg-dark">{{ $task->status }}</span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-dark btn-sm">Details</a>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-outline-dark btn-sm">Edit</a>

                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No tasks found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

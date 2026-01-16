@extends('layouts.admin-layout')

@section('content')
    <div class="card border-all mt-5">
        <div class="card-header d-flex justify-content-between align-items-center border-bottom-custom">
            <h3>Projects</h3>

            <form action="{{ route('projects.index') }}" method="GET" class="d-flex w-25">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control border-all"
                       placeholder="Search...">
                <button type="submit" class="btn btn-dark ms-2">Find</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="projectsTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date of creation</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($projects as $project)
                    <tr class="border-all">
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td>{{ Str::limit($project->description, 50) }}</td>
                        <td>{{ $project->created_at->format('d.m.Y') }}</td>
                        <td class="">
                            <div class="d-flex gap-2">
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-dark btn-sm">Details</a>
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-outline-dark btn-sm">Edit</a>

                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="">
                        <td colspan="5" class="text-center">No projects found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

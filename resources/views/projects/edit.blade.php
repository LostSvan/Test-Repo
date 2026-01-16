@extends('layouts.admin-layout')

@section('content')
    <div class="card border-all mt-5">
        <div class="card-header border-bottom-custom">
            <h3>Edit Project: {{ $project->title }}</h3>
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

            <form action="{{ route('projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control border-all" value="{{ old('title', $project->title) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control border-all" rows="3">{{ old('description', $project->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-dark">Update Project</button>
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection

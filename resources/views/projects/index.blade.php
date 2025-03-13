@extends('layouts.app')

@section('content')
    <h1>Projects</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('projects.create') }}" class="btn btn-primary">Create Project</a> <a href="{{ route('projects.export') }}" class="btn btn-success">
    Export to Excel
</a>
  <br> <br>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('projects.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search projects..." value="{{ request()->input('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                    @if(request()->input('search'))
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Clear Search</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Ref</th>
                <th>Nom Projet</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>{{ $project->ref }}</td>
                    <td>{{ $project->nom_projet }}</td>
                    <td>{{ $project->description }}</td>
                    <td>
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-info">View</a>
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

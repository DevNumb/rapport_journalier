@extends('layouts.app')

@section('content')
    <h1>Edit Project</h1>

    <form action="{{ route('projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="ref">Ref</label>
            <input type="text" name="ref" id="ref" class="form-control" value="{{ $project->ref }}" required>
        </div>
        <div class="form-group">
            <label for="nom_projet">Nom Projet</label>
            <input type="text" name="nom_projet" id="nom_projet" class="form-control" value="{{ $project->nom_projet }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $project->description }}</textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection


@extends('layouts.app')

@section('content')
    <h1>Create Project</h1>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ref">Ref</label>
            <input type="text" name="ref" id="ref" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nom_projet">Nom Projet</label>
            <input type="text" name="nom_projet" id="nom_projet" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection

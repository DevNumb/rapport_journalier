@extends('layouts.app')

@section('content')
    <h1>Create Activity</h1>

    <form action="{{ route('activities.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom_projet">Nom Projet</label>
            <input type="text" name="nom_projet" id="nom_projet" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="duree_debut">Duree Debut</label>
            <input type="datetime-local" name="duree_debut" id="duree_debut" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="duree_fin">Duree Fin</label>
            <input type="datetime-local" name="duree_fin" id="duree_fin" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection

@extends('layouts.app')

@section('content')
    <h1>Edit Activity</h1>

    <form action="{{ route('activities.update', $activity) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom_projet">Nom Projet</label>
            <input type="text" name="nom_projet" id="nom_projet" class="form-control" value="{{ $activity->nom_projet }}" required>
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
            <textarea name="description" id="description" class="form-control">{{ $activity->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <br>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

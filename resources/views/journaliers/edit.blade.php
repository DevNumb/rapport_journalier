@extends('layouts.app')

@section('content')

    <h1>Edit Journalier Entry</h1>

    <form action="{{ route('journaliers.update', $journalier) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $journalier->nom }}" required>
        </div>
        <div class="form-group">
            <label for="projet">Projet</label>
            <input type="text" name="projet" id="projet" class="form-control" value="{{ $journalier->projet }}" required>
        </div>
        <div class="form-group">
            <label for="duree_debut">Duree Debut (HH:MM)</label>
            <input type="time" name="duree_debut" id="duree_debut" class="form-control" value="{{ $journalier->duree_debut }}" required>
        </div>
        <div class="form-group">
            <label for="duree_fin">Duree Fin (HH:MM)</label>
            <input type="time" name="duree_fin" id="duree_fin" class="form-control" value="{{ $journalier->duree_fin }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $journalier->description }}</textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

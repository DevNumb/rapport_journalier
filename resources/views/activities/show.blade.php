@extends('layouts.app')

@section('content')
    <h1>Activity Details</h1>

    <p><strong>Nom Projet:</strong> {{ $activity->nom_projet }}</p>
    <p><strong>Duree Debut:</strong> {{ $activity->duree_debut }}</p>
    <p><strong>Duree Fin:</strong> {{ $activity->duree_fin }}</p>
    <p><strong>Description:</strong> {{ $activity->description }}</p>
    <p><strong>Date:</strong> {{ $activity->date }}</p>

    <a href="{{ route('activities.index') }}" class="btn btn-primary">Back to List</a>
@endsection

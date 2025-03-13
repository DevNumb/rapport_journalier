@extends('layouts.app')

@section('content')
    <h1>Journalier Entry Details</h1>

    <p><strong>Nom:</strong> {{ $journalier->nom }}</p>
    <p><strong>Projet:</strong> {{ $journalier->projet }}</p>
    <p><strong>Duree Debut:</strong> {{ $journalier->duree_debut }}</p>
    <p><strong>Duree Fin:</strong> {{ $journalier->duree_fin }}</p>
    <p><strong>Description:</strong> {{ $journalier->description }}</p>
    <p><strong>Date:</strong> {{ $date }}</p>

    <a href="{{ route('journaliers.index') }}" class="btn btn-primary">Back to List</a>
@endsection

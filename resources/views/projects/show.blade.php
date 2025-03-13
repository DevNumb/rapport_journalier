@extends('layouts.app')

@section('content')
    <h1>Project Details</h1>

    <p><strong>Ref:</strong> {{ $project->ref }}</p>
    <p><strong>Nom Projet:</strong> {{ $project->nom_projet }}</p>
    <p><strong>Description:</strong> {{ $project->description }}</p>

    <a href="{{ route('projects.index') }}" class="btn btn-primary">Back to List</a>
@endsection

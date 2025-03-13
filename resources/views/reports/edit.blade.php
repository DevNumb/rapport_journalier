@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-3">Edit Report</h1>
        <form method="POST" action="{{ route('reports.update', $report->id) }}" class="needs-validation">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Report Name:</label>
                <input type="text" id="name" name="name" value="{{ $report->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" required>{{ $report->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="module" class="form-label">Module:</label>
                <select id="module" name="module" class="form-select" required>
                    <option value="Activite" {{ $report->module == 'Activite' ? 'selected' : '' }}>Activite</option>
                    <option value="Projet" {{ $report->module == 'Projet' ? 'selected' : '' }}>Projet</option>
                    <option value="Tache" {{ $report->module == 'Tache' ? 'selected' : '' }}>Tache</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('reports.index') }}" class="btn btn-secondary ms-2">Return to Reports List</a>
        </form>
    </div>
@endsection

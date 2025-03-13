@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-3">Create Report</h1>
        <form method="POST" action="{{ route('reports.store') }}" class="needs-validation">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Report Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="module" class="form-label">Module:</label>
                <select id="module" name="module" class="form-select" required>
                    <option value="Activite">Activite</option>
                    <option value="Projet">Projet</option>
                    <option value="Tache">Tache</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('reports.index') }}" class="btn btn-secondary ms-2">Return to Reports List</a>
        </form>
    </div>
@endsection

@extends('layouts.app')

@php
use Carbon\Carbon;
@endphp

@section('content')




    <h1>Journalier Entries</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <a href="{{ route('journaliers.create') }}" class="btn btn-primary">Create Journalier Entry</a>  <a href="{{ route('journaliers.export') }}" class="btn btn-success">
    Export to Excel
</a>
 <br><br>
    <div class="row">
    <div class="col-md-12">
        <form action="{{ route('activities.index') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search activities by project name or description..." value="{{ request()->input('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
                @if(request()->input('search'))
                    <a href="{{ route('activities.index') }}" class="btn btn-secondary">Clear Search</a>
                @endif
            </div>
        </form>
    </div>
</div>
    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Projet</th>
                <th>Duree Debut</th>
                <th>Duree Fin</th>
                <th>Duration (Hours)</th>
                <th>Description</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($journaliers as $journalier)
                <tr>
                    <td>{{ $journalier->nom }}</td>
                    <td>{{ $journalier->projet }}</td>
                    <td>{{ $journalier->duree_debut }}</td>
                    <td>{{ $journalier->duree_fin }}</td>
                    <td>
                        @php
                            $start = Carbon::parse($journalier->duree_debut);
                            $end = Carbon::parse($journalier->duree_fin);
                            $duration = $end->diffInHours($start);
                        @endphp
                        {{ $duration }}
                    </td>
                    <td>{{ $journalier->description }}</td>
                    <td>{{ $journalier->date }}</td>
                    <td>
                        <div class="d-flex flex-wrap">
                            <a href="{{ route('journaliers.show', $journalier) }}" class="btn btn-sm btn-info me-1 mb-1">View</a>
                            <a href="{{ route('journaliers.edit', $journalier) }}" class="btn btn-sm btn-primary me-1 mb-1">Edit</a>
                            <form action="{{ route('journaliers.destroy', $journalier) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger me-1 mb-1">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

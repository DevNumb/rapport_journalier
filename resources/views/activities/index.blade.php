
@extends('layouts.app')

@section('content')

    <h1>Activities</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif



    <a href="{{ route('activities.export') }}" class="btn btn-success">Export to Excel</a>





    <a href="{{ route('activities.create') }}" class="btn btn-primary">Create Activity</a>
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
    <table class="table">
        <thead>
            <tr>
                <th>Nom Projet</th>
                <th>Duree Debut</th>
                <th>Duree Fin</th>
                <th>Description</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->nom_projet }}</td>
                    <td>{{ $activity->duree_debut }}</td>
                    <td>{{ $activity->duree_fin }}</td>
                    <td>{{ $activity->description }}</td>
                    <td>{{ $activity->date }}</td>
                    <td>
    <div class="d-flex">
        <a href="{{ route('activities.show', $activity) }}" class="btn btn-info py-1 px-2">View</a>
        
        <a href="{{ route('activities.edit', $activity) }}" class="btn btn-primary py-1 px-2 ms-1">Edit</a>
        
        <form action="{{ route('activities.destroy', $activity) }}" method="POST" style="display: inline-block; margin-left: 1px;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger py-1 px-2 ms-1">Delete</button>
        </form>
    </div>
</td>


                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

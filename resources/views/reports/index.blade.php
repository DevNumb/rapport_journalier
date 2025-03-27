@extends('layouts.app')

@section('title', 'Mon rapport')

@section('content')
    <div class="container">
        <h1>Reports Index</h1>

        <a href="{{ route('reports.create') }}" class="btn btn-primary">Create New Report</a>  <a href="{{ route('reports.export') }}" class="btn btn-success">
    Export to Excel
</a>
 <br><br>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('reports.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Search reports..." value="{{ request()->input('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                        @if(request()->input('search'))
                            <a href="{{ route('reports.index') }}" class="btn btn-secondary">Clear Search</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
      
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Report Name</th>
                    <th>Description</th>
                    <th>Module</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{ $report->name }}</td>
                        <td>{{ $report->description }}</td>
                        <td>{{ $report->module }}</td>
                        <td>
                            <a href="{{ route('reports.show', $report->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

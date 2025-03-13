@extends('layouts.app')

@section('content')
    <h1>Activity Logs</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Log Name</th>
                <th>Description</th>
                <th>Subject Type</th>
                <th>Subject ID</th>
                <th>Causer Type</th>
                <th>Causer ID</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->log_name }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->subject_type }}</td>
                    <td>{{ $log->subject_id }}</td>
                    <td>{{ $log->causer_type }}</td>
                    <td>{{ $log->causer_id }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@extends('layouts.app')

@section('content')
    <h1>Show Report</h1>
    <p>Report Name: {{ $report->name }}</p>
    <p>Description: {{ $report->description }}</p>
    <p>Module: {{ $report->module }}</p>
    <a href="{{ route('reports.index') }}" class="btn btn-secondary">Return to Reports List</a>
@endsection

<form action="{{ route('reports.store') }}" method="POST">
    @csrf
    <label for="worker_id">Worker:</label>
    <select name="worker_id" id="worker_id">
        @foreach($workers as $worker)
            <option value="{{ $worker->id }}">{{ $worker->name }}</option>
        @endforeach
    </select>

    <label for="date">Date:</label>
    <input type="date" name="date" id="date">

    <label for="description">Description:</label>
    <textarea name="description" id="description"></textarea>

    <label for="hours_worked">Hours Worked:</label>
    <input type="number" name="hours_worked" id="hours_worked">

    <button type="submit">Submit</button>
</form>
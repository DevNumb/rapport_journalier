<table>
    <thead>
        <tr>
            <th>Worker</th>
            <th>Date</th>
            <th>Hours Worked</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $report)
            <tr>
                <td>{{ $report->worker->name }}</td>
                <td>{{ $report->date }}</td>
                <td>{{ $report->hours_worked }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
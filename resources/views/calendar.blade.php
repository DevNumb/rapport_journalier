@extends('layouts.app')

@section('title', 'Calendar')

@section('content')


<!DOCTYPE html>
<html lang="en">
<head>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Calendar</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <style>
        #calendar {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .fc-toolbar-title {
            font-size: 1.5em;
        }

        .modal-content {
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-light">


    <div id="calendar"></div>

    <!-- Add Event Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Add Event</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addEventForm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Start Time</label>
                            <input type="datetime-local" name="start" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">End Time</label>
                            <input type="datetime-local" name="end" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Add Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Event Modal -->
    <div class="modal fade" id="editEventModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Event</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editEventForm">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Start Time</label>
                            <input type="datetime-local" name="start" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">End Time</label>
                            <input type="datetime-local" name="end" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
    left: 'prevYear,prev,next,nextYear today',
    center: 'title',
    right: 'timeGridWeek,timeGridDay'
},

                initialView: 'timeGridWeek',  // Show in week time grid
                slotMinTime: '08:00:00',
                slotMaxTime: '20:00:00',
                nowIndicator: true,
                navLinks: true,
                editable: true,
                selectable: true,
                  select: function(info) {
                 // Open add event modal
                    const modal = new bootstrap.Modal(document.getElementById('addEventModal'));
                    const form = document.getElementById('addEventForm');

                                        // Reset form
                    form.reset();
                 // Set start and end if available
                    form.querySelector('[name="start"]').value = info.startStr.slice(0, 16);
                    form.querySelector('[name="end"]').value = info.endStr.slice(0, 16);
                    // Handle add form submission
                 form.onsubmit = async (e) => {
                        e.preventDefault();
                     const formData = new FormData(form);

                        try {
                            const response = await fetch('/events', {  // Create route
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                },
                                body: formData
                            });

                            if (response.ok) {
                                const newEvent = await response.json();
                                calendar.addEvent(newEvent);  // Add new event
                                calendar.refetchEvents();  // refetch
                                modal.hide();  // Hide modal
                                console.log('Event added successfully:', newEvent);  // log
                            } else {
                                console.error('Failed to add event. Response status:', response.status);  // status
                                const errorText = await response.text();
                                console.error('Response text:', errorText);  // show to console
                            }
                        } catch (error) {
                            console.error('Error:', error);  // console
                        }
                    };

                    modal.show();
                },

                events: @json($events),
 eventContent: function(arg) {
                let content = document.createElement('div');
                content.innerHTML = arg.event.title; // Display title

                if(arg.event.extendedProps.description) {
                    let description = document.createElement('div');
                    description.innerHTML = arg.event.extendedProps.description;  // Display description
                    content.appendChild(description);
                }

                return { domNodes: [content] };
            },
              eventDidMount: function(info) {
                    info.el.style.cursor = 'pointer';
                },
                                    eventClick: function (info) {
                    const modal = new bootstrap.Modal(document.getElementById('editEventModal'));
                    const form = document.getElementById('editEventForm');

                    // Populate form
                    form.querySelector('[name="title"]').value = info.event.title || '';
                    form.querySelector('[name="start"]').value = info.event.start ? info.event.start.toISOString().slice(0, 16) : '';
                    form.querySelector('[name="end"]').value = info.event.end ? info.event.end.toISOString().slice(0, 16) : '';
                    form.querySelector('[name="description"]').value = info.event.extendedProps.description || '';

                    // Update form action
                    form.action = `/events/${info.event.id}`;

                    // Handle form submission
                    form.onsubmit = async (e) => {
                        e.preventDefault();
                        const formData = new FormData(form);

                        try {
                            const response = await fetch(form.action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'X-HTTP-Method-Override': 'PUT'
                                },
                                body: formData
                            });

                            if (response.ok) {
                                const updatedEvent = await response.json();
                                info.event.setProp('title', updatedEvent.title);
                                info.event.setDates(updatedEvent.start, updatedEvent.end);
                                calendar.refetchEvents();
                                modal.hide();
                            }
                        } catch (error) {
                            console.error('Error:', error);
                        }
                    };

                    modal.show();
                }
            });
            calendar.render();
        });
    </script>
 

</body>
        
</html>
@endsection



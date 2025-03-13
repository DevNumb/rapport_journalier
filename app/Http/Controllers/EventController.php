<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('calendar', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date|after:start',
            'description' => 'nullable|string'
        ]);
    
        $event = Event::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description
        ]);
        return response()->json($event);
    }

    public function update(Request $request, Event $event)
    {
        $event->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['success' => true]);
    }
}


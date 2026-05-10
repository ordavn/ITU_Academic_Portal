<?php

namespace App\Http\Controllers;
use App\Models\Event;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
{
    $events = Event::all();
    return view('events.index', compact('events'));
}

public function create()
{
    return view('events.create');
}


public function store(Request $request)
{
    $request->validate([
        'event_name' => 'required|string|max:255',
        'date' => 'required|date',
        'location' => 'required|string|max:255',
    ]);

    Event::create($request->all());
    
    return redirect()->route('events.index')->with('success', 'Event created successfully.');
}

public function show($id)
{
    $event = Event::findOrFail($id);
    return view('events.show', compact('event'));
}

public function edit($id)
{
    $event = Event::findOrFail($id);
    return view('events.edit', compact('event'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'event_name' => 'required|string|max:255',
        'date' => 'required|date',
        'location' => 'required|string|max:255',
    ]);

    $event = Event::findOrFail($id);
    $event->update($request->all());
    
    return redirect()->route('events.index')->with('success', 'Event updated successfully.');
}

public function destroy($id)
{
    $event = Event::findOrFail($id);
    $event->delete();
    
    return redirect()->route('events.index');
}
}

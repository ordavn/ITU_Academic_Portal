<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return new EventResource(true, 'List of events', $events);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Correction : créer l'événement et le stocker dans $event
        $event = Event::create([
            'event_name' => $request->event_name,
            'date' => $request->date,
            'location' => $request->location,
            'image' => $request->image,
            'description' => $request->description,
        ]);

        return new EventResource(true, 'Event created successfully', $event);
    }

    public function show($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        return new EventResource(true, 'Event details', $event);
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'event_name' => 'sometimes|string|max:255',
            'date' => 'sometimes|date',
            'location' => 'sometimes|string|max:255',
            'image' => 'nullable|string',
            'description' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Correction : ajouter 'description' à la mise à jour
        $event->update($request->only(['event_name', 'date', 'location', 'image', 'description']));

        return new EventResource(true, 'Event updated successfully', $event);
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $event->delete();
        return new EventResource(true, 'Event deleted successfully', null);
    }
}
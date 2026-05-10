<h1>Edit Event</h1>

<form action="{{ route('events.update', $event->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div>
        <label>Event Name :</label>
        <input type="text" name="event_name" value="{{ $event->event_name }}" required>
    </div>
    
    <div>
        <label>Date :</label>
        <input type="date" name="date" value="{{ $event->date }}" required>
    </div>
    
    <div>
        <label>Location :</label>
        <input type="text" name="location" value="{{ $event->location }}" required>
    </div>
    
    <button type="submit">Update</button>
</form>

<a href="{{ route('events.index') }}">Back to List</a>
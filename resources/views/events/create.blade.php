<h1>Add Event</h1>

<form action="{{ route('events.store') }}" method="POST">
    @csrf
    
    <div>
        <label>Event Name :</label>
        <input type="text" name="event_name" required>
    </div>
    
    <div>
        <label>Date :</label>
        <input type="date" name="date" required>
    </div>
    
    <div>
        <label>Location :</label>
        <input type="text" name="location" required>
    </div>
    
    <button type="submit">Save</button>
</form>

<a href="{{ route('events.index') }}">Back to List</a>
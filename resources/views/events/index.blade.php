<h1>Events List</h1>

<a href="{{ route('events.create') }}">Add Event</a>

@if(session('success'))
    <div style="color: green; border: 1px solid green; padding: 10px; margin: 10px 0;">
        {{ session('success') }}
    </div>
@endif

<table border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Location</th>
            <th>View</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td>{{ $event->event_name }}</td>
            <td>{{ $event->date }}</td>
            <td>{{ $event->location }}</td>
            <td>
                <a href="{{ route('events.show', $event->id) }}">View</a>
            </td>
            <td>
                <a href="{{ route('events.edit', $event->id) }}">Edit</a>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
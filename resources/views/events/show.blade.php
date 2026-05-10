<h1>Event Details</h1>

<p><strong>Name :</strong> {{ $event->event_name }}</p>
<p><strong>Date :</strong> {{ $event->date }}</p>
<p><strong>Location :</strong> {{ $event->location }}</p>

<a href="{{ route('events.index') }}">Back to List</a>
<h1 align="center">Hello {{ $name }}</h1>

<p>We are sending you your ticket for the event "{{ $event->title }}".</p>

<hr>

<p>A reminder of the event details are provided bellow</p>

<ul>
	<li><strong>Date:</strong> {{ $event->date }}</li>
	<li><strong>Location:</strong> {{ $event->address }} {{ $event->number }}, {{ $event->city }}</li>
</ul>

<hr>

<p><strong>Keep in mind that you have to bring your ticket with you at the event.</strong></p>

<br><br>

<p>Best regards,
<br>
Cringe.</p>
<h1>New Curtains Kenya enquiry</h1>

<p><strong>Name:</strong> {{ $contactDetails['name'] }}</p>
<p><strong>Email:</strong> {{ $contactDetails['email'] }}</p>
@if (! empty($contactDetails['phone']))
<p><strong>Phone:</strong> {{ $contactDetails['phone'] }}</p>
@endif
<p><strong>Subject:</strong> {{ $contactDetails['subject'] }}</p>
<p><strong>Message:</strong></p>
<p>{{ $contactDetails['message'] }}</p>

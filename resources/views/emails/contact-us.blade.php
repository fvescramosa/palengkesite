@component('mail::message')
# Contact Us: {{ $contact->subject }}

<p><strong>From: </strong>{{ $contact->name }} < {{ $contact->from }} > </p>
<p><label for=""><strong>Subject: </strong></label> {{ $contact->subject }}</p>

<p><label for=""> <strong>Message: </strong></label></p>
<p> {{ $contact->message }}  </p>






@endcomponent

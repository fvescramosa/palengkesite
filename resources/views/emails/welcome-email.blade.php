@component('mail::message')
# Welcome to Palengkesite!

<p>Thank you for signing up!</p>

<p>To get started, you must click the link below to activate your account.</p>

@component('mail::button', ['url' => route('user.verify', ['email' => $data['email'], 'code' => $data['code']])])
ACTIVATION LINK HERE
@endcomponent


Sincerely,
Palengkesite


Thanks,<br>
{{ config('app.name') }}
@endcomponent

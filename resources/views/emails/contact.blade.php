@component('mail::message')
# Contact

<p>Someone has contacted us</p>
<p>It is {{ $user->name }} with the mail : {{ $user->email }}</p>
<p>Here is his message</p>
@component('mail::panel')
    {!! $content !!}
@endcomponent

@endcomponent
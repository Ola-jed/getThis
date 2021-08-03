@component('mail::message')
# GetThis account deleted

<p>Dear {{ $user->name }}</p>
<p>
    We are we are very sad to see you leave our platform.<br>
    We wish you a good continuation and we remain in the hope to see you again.<br>
    Do not hesitate to come back to our platform.
</p>

@component('mail::button', ['url' => env('APP_URL')])
    Come back to GetThis
@endcomponent

Thanks,<br>
@endcomponent
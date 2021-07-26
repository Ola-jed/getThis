@component('mail::message')
# Registration to GetThis

Dear {{ $user->name }}<br>
We are happy to welcome you among us. <br>

@component('mail::button', ['url' => url() ])
    Take a look at getThis
@endcomponent

Thanks
@endcomponent
@component('mail::message')
# GetThis account deleted

<p>Dear {{ $user->name }}</p>
<p>
    We are we are very sad to see you leave our platform.<br>
    We wish you a good continuation and we remain in the hope to see you again.<br>
    Do not hesitate to come back to <a href="#">our platform</a>
</p>

@component('mail::button', ['url' => 'https://get-this.herokuapp.com'])
    Come back to GetThis
@endcomponent

Thanks,<br>
@endcomponent
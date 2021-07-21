@component('mail::message')
# User reported

<p>A user have been reported</p>

<p>Here are the user information : </p>
<ul>
    <li>Id : {{ $user->id }}</li>
    <li>Name : {{ $user->name }}</li>
    <li>Email : {{ $user->email }}</li>
</ul>

<p>Report cause :</p>
@component('mail::panel')
    {!! $message !!}
@endcomponent
@endcomponent
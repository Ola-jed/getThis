@component('mail::message')
# Report of a new User

<p>A user have been reported</p>
<p>Here are the information : </p>

<ul>
    <li>Id : {{ $user->id }}</li>
    <li>Name : {{ $user->name }}</li>
    <li>Email : {{ $user->email }}</li>
</ul>

@endcomponent
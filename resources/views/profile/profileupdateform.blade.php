<form action="{{ url('/profile') }}" method="post" id="profile-update" class="box has-background-dark has-text-white column is-4 is-offset-4">
    @csrf
    @method('PUT')
    <h5 class="has-text-centered has-text-light is-white title is-5">Update account</h5>
    <div class="field column">
        <label for="name" class="label has-text-white">Name</label>
        <input id="name" type="text" name="name" class="input is-primary" value="{{ session()->get('user')->name }}" maxlength="25" required>
        @error('name')
            <div class="help is-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="field column">
        <label for="email" class="label has-text-white">Email</label>
        <input type="email" id="email" name="email" class="input is-primary" value="{{ session()->get('user')->email }}" required>
        @error('email')
            <div class="help is-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="field column">
        <label for="initial_password" class="label has-text-white">Password</label>
        <input type="password" id="initial_password" name="initial_password" class="input is-primary" placeholder="*****" required>
        @error('initial_password')
            <div class="help is-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="field column">
        <label for="new_password" class="label has-text-white">New password (Optional)</label>
        <input type="password" id="new_password" name="new_password" class="input is-primary">
        @error('new_password')
            <div class="help is-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="field column">
        <label for="new_password_confirm" class="label has-text-white">New password validation (Optional)</label>
        <input type="password" id="new_password_confirm" name="new_password_confirm" class="input is-primary" >
        @error('new_password_confirm')
            <div class="help is-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="column">
        <button type="submit" class="button is-primary">Update</button>
    </div>
</form>

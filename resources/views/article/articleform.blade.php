<form action="{{ url('/articles') }}" method="post" class="creation box">
    @csrf
    <h3>New article</h3>
    <div class="field">
        <label for="subject" class="label has-text-black">Subject</label>
        <input type="text" class="input is-primary" name="subject" placeholder="Subject" maxlength="25" required>
        @error('subject')
            <div class="help is-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="field">
        <label for="subject" class="label has-text-black">Title</label>
        <input type="text" class="input is-primary" name="title" placeholder="Title" maxlength="25" required>
        @error('title')
            <div class="help is-danger">{{ $message }}</div>
        @enderror
    </div>
    <textarea name="content" id="content" cols="30" rows="10" class="textarea is-primary" placeholder="My beautiful and incredible article" required></textarea><br>
    @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <button type="submit" class="button is-primary">Create</button>
</form>

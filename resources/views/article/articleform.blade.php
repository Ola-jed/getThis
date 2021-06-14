<form action="{{ url('/articles') }}" method="post" class="creation box">
    @csrf
    <h3>New article</h3>
    <div class="field">
        <label for="subject" class="label has-text-black">Subject</label>
        <input type="text" class="input is-primary" name="subject" placeholder="Subject" required>
        @error('subject')
            <div class="help is-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="field">
        <label for="subject" class="label has-text-black">Title</label>
        <input type="text" class="input is-primary" name="title" placeholder="Title" required>
        @error('title')
            <div class="help is-danger">{{ $message }}</div>
        @enderror
    </div>
    <label class="label has-text-black">Content</label>
    <div id="editor" class="textarea is-primary"></div>
    <textarea name="content" id="content" hidden required></textarea><br>
    @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <button type="submit" class="button is-primary" id="create-article">Create</button>
</form>
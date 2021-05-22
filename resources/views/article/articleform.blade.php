<form action="{{ url('/articles') }}" method="post" class="article-creation">
    @csrf
    <h3>New article</h3>
    <label for="subject"></label><input type="text" name="subject" placeholder="Subject" required><br>
    @error('subject')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <label for="title"></label><input type="text" name="title" placeholder="Title" required><br>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <textarea name="content" id="content" cols="30" rows="10" required></textarea><br>
    @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <button type="submit">Create</button>
</form>

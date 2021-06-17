<form action="{{ url('/discussion/'.$discussion->id) }}" method="post" class="box" id="message-form">
    @csrf
    <div class="field">
        <textarea name="content" class="textarea is-primary" placeholder="Your message" id="message-content" required></textarea>
    </div>
    <button type="submit" class="button is-primary" id="submit-message">Post</button>
</form>
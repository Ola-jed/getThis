<form action="{{ url('/discussions') }}" method="post" class="discussion-creation box">
    @csrf
    <h3 class="is-centered">New discussion</h3>
    <div class="field">
        <label for="subject" class="label has-text-black">Subject</label>
        <input type="text" class="input is-primary" name="subject" placeholder="Subject" required>
        @error('subject')
            <div class="help is-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="button is-primary">Create</button>
</form>

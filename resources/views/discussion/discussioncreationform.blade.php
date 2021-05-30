<form action="{{ url('/discussions') }}" method="post" class="creation box">
    @csrf
    <h3>New discussion</h3>
    <div class="field">
        <label for="subject" class="label has-text-black">Subject</label>
        <input type="text" class="input is-primary" name="subject" placeholder="Subject" maxlength="25" required>
        @error('subject')
            <div class="help is-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="button is-primary">Create</button>
</form>

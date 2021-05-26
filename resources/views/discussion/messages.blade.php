@foreach($messages as $message)
    <div class="box">
        <p><a href="{{ url('/profile/'.$message->writer_id) }}">{{ \App\Models\User::find($message->writer_id)->name }}</a></p>
        <p>{{ $message->content }}</p>
        <p class="is-small are-small">{{ date('F j , Y H:i:s', strtotime($message->created_at)) }}</p>
        {{-- Delete form here --}}
    </div>
@endforeach

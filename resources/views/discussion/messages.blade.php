@foreach($messages as $message)
    <div class="box">
        <p><a href="{{ url('/profile/'.$message->writer_id) }}">{{ \App\Models\User::find($message->writer_id)->name }}</a></p>
        <p>{{ $message->content }}</p>
        <hr>
        <p class="has-text-black">{{ date('F j , Y H:i:s', strtotime($message->created_at)) }}</p>
        @if(\Illuminate\Support\Facades\Session::get('user')->id === $message->writer_id)
            <form action="{{ url('/message/'.$message->id) }}" method="post" class="message-delete">
                @csrf
                @method('DELETE')
                <button class="button is-danger"><img src="{{ asset('images/delete.svg') }}" alt="Delete"></button>
            </form>
        @endif
    </div>
@endforeach

@foreach($comments as $comment)
    <div class="comment">
        <p class="comment-author"><a href="{{ url('/profile/'.$comment->writer_id) }}">{{ \App\Models\User::find($comment->writer_id)->name }}</a></p>
        <p class="comment-content">{{ $comment->content }}</p>
        <p class="comment-date">{{ date('j F, Y', strtotime($comment->created_at)) }}</p>
        @if(\Illuminate\Support\Facades\Session::get('user')->id === $comment->writer_id)
            <form action="{{ url('/comment/'.$comment->id) }}" method="post" class="delete-form" onsubmit="return false">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        @endif
    </div>
@endforeach

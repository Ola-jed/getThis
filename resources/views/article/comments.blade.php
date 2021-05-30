@foreach($comments as $comment)
    <div class="comment">
        <p class="comment-author"><a href="{{ url('/account/'.$comment->user_id) }}">{{ $comment->user->name }}</a></p>
        <p class="comment-content">{{ $comment->content }}</p>
        <p class="comment-date">{{ date('j F, Y H:i:s', strtotime($comment->created_at)) }}</p>
        @if(\Illuminate\Support\Facades\Session::get('user')->id === $comment->user_id)
            <form action="{{ url('/comment/'.$comment->id) }}" method="post" class="delete-form" onsubmit="return false">
                @csrf
                @method('DELETE')
                <button type="submit" class="button is-danger"><img src="{{ asset('images/delete.svg') }}" alt="delete"></button>
            </form>
        @endif
    </div>
@endforeach

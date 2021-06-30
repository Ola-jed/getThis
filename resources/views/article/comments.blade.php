@foreach($comments as $comment)
    <div class="comment">
        <p class="comment-author"><a href="{{ url('/account/'.$comment->user_id) }}">{{ $comment->user->name }}</a></p>
        <p class="comment-content">{{ $comment->content }}</p>
        <p class="comment-date">{{ date('j F, Y H:i:s', strtotime($comment->created_at)) }}</p>
        @if(session()->get('user')->id === $comment->user_id)
            <form action="{{ url('/comment/'.$comment->id) }}" method="post" class="delete-form" onsubmit="return false">
                @csrf
                @method('DELETE')
                <button type="submit" class="button is-danger">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </form>
        @endif
    </div>
@endforeach
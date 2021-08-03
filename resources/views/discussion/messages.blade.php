@foreach($messages as $message)
    <div class="box">
        <p><a href="{{ url('/account/'.$message->user_id) }}">{{ $message->user->name }}</a></p>
        <p>{{ $message->content }}</p>
        <hr>
        <div class="columns">
            <div class="column is-half">
                <p class="has-text-black">{{ $message->created_at->toDayDateTimeString() }}</p>
            </div>
            <div class="column is-half delete-btn">
                @if(session()->get('user')->id === $message->user_id)
                    <form action="{{ url('/message/'.$message->id) }}" method="post" class="message-delete">
                        @csrf
                        @method('DELETE')
                        <button class="button is-danger">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
                @endif
            </div>
        </div>

    </div>
@endforeach

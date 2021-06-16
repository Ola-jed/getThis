@foreach($discussions as $discussion)
    <div class="discussion box">
        <p class="discussion-title"><a href="{{ url('discussion/'.$discussion->id) }}">{{ $discussion->subject }}</a></p>
        <p class="discussion-message-number">{{ $discussion->messages_count }} message(s)</p>
        <p>Active since {{ date('F j, Y H:i:s', strtotime($discussion->created_at)) }}</p>
    </div>
@endforeach
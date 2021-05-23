@foreach($articles as $article)
    <div class="article box">
        <p class="article-title"><a href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></p>
        <p class="article-subject box has-background-dark has-text-white column is-one-third"> {{ $article->subject }}</p>
        <p class="article-author"><a href="{{ url('/profile/'.\App\Models\User::find($article->writer_id)->id) }}">{{ \App\Models\User::find($article->writer_id)->name }}</a>, the {{ date('F j, Y H:i:s', strtotime($article->created_at)) }}</p>
        @if(\Illuminate\Support\Facades\Session::get('user')->id === $article->writer_id)
            <form action="{{ url('/article/'.$article->id) }}" method="post" class="delete-article" onsubmit="return false">
                @csrf
                @method('DELETE')
                <button type="submit" class="button is-danger">Delete</button>
            </form>
        @endif
    </div>
@endforeach

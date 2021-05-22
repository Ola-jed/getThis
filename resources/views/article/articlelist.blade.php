@foreach($articles as $article)
    <div class="article">
        <p class="article-title"><a href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></p>
        <p class="article-subject"> {{ $article->subject }}</p>
        <p class="article-author">Written the {{ date('j F, Y', strtotime($article->created_at)) }} by <a href="{{ url('/profile/'.\App\Models\User::find($article->writer_id)->id) }}">{{ \App\Models\User::find($article->writer_id)->name }}</a></p>
        @if(\Illuminate\Support\Facades\Session::get('user')->id === $article->writer_id)
            <form action="{{ url('/article/'.$article->id) }}" method="post" class="delete-article" onsubmit="return false">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        @endif
    </div>
@endforeach

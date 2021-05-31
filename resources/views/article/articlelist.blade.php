@foreach($articles as $article)
    <div class="article box">
        <p class="article-title"><a href="{{ url('article/'.$article->slug) }}">{{ $article->title }}</a></p>
        <p class="article-subject box has-background-dark has-text-white column is-one-third"> {{ $article->subject }}</p>
        <p class="article-author"><a href="{{ url('/profile/'.$article->user_id) }}">{{ $article->user->name }}</a>, the {{ date('F j, Y H:i:s', strtotime($article->created_at)) }}</p>
        @if(\Illuminate\Support\Facades\Session::get('user')->id === $article->user_id)
            <form action="{{ url('/article/'.$article->slug) }}" method="post" class="delete-article" onsubmit="return false">
                @csrf
                @method('DELETE')
                <button type="submit" class="button is-danger">
                    <img src="{{ asset('images/delete.svg') }}" alt="delete">
                </button>
            </form>
        @endif
    </div>
@endforeach

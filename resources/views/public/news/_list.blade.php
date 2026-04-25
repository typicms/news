<ul class="news-list-list">
    @foreach ($items as $news)
        @include('public::news._list-item')
    @endforeach
</ul>

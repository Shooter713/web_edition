@include('inc.header')

<div class="container">
    <div class="news-block jumbotron mt-2">
        @if($news)
            <div class="mt-3">
                <div class="col-md-12">
                    <div class="alert alert-warning row">
                        <div class="col-md-4">
                            <div class="item-image">
                                <img src="/uploads/{{ $news->image }}">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="item-head">
                                <div class="item-name">{{ $news->name }}</div>
                                <div class="item-created_at">{{ $news->created_at }}</div>
                            </div>
                            <div class="item-name mt-3">{{ $news->text }}</div>
                        </div>
                    </div>
                    @if($next)
                        <a href="/news/{{$next->id}}">Назад</a>
                    @endif
                    @if($prev)
                        <a href="/news/{{$prev->id}}">Вперед</a>
                    @endif
                </div>
            </div>
            <div class="news-link">
                @foreach($links as $link)
                    <a href="/news/{{$link->id}}">{{$link->name}}</a>
                @endforeach
            </div>
        @endif
    </div>
</div>

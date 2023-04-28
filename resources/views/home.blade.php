@include('inc.header')

<div class="container">
    <div class="mt-2">@include('inc.messages')</div>
    <div class="news-block jumbotron mt-2">
        <h1 class="text-center">Список статей</h1>
        @if($news)
            @foreach($news as $item)
                <a href="/news/{{$item->id}}">
                    <div class="mt-4">
                        <div class="col-md-12">
                            <div class="alert alert-primary row">
                                <div class="col-md-4">
                                    <div class="item-image">
                                        <img src="/uploads/{{ $item->image }}">
                                    </div>
                                </div>
                                <div class="col-md-8 item-head">
                                    <div class="item-name">{{ $item->name }}</div>
                                    <div class="item-created_at">{{ $item->created_at }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            <div>{{ $news->links() }}</div>
        @endif
    </div>
</div>

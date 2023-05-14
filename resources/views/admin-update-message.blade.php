@include('inc.header')

<div class="container">
    <div class="col-md-8 mt-2">
        <h1>Оновлення запису</h1>
        @if($errors->any())
            <div class="alert alert-danger mt-2">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/admin/update-news/{{$data->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Введіть ім'я</label>
                <input type="text" name="name" value="{{ $data->name }}" placeholder="Введіть ім'я" id="name" class="form-control">
            </div>
            <div class="form-group">
                <input type="file" name="/uploads/{{ $data->image }}" onchange="document.getElementById('file-news').remove()" >
                <img id="file-news" src="/uploads/{{ $data->image }}" style="width: 100px; height: 100px">
            </div>
            <div class="form-group">
                <label for="tags">Теги</label>
                <input type="text" name="tags" value="{{ $tags }}" placeholder="Введіть теги через кому" id="subject" class="form-control">
            </div>
            <div class="form-group">
                <label for="text">Введіть текст повідомлення</label>
                <textarea name="text" class="form-control" placeholder="Введіть текст повідомлення">{{ $data->text }}</textarea>
            </div>
            <div class="form-group">
                <label for="check">Активність статті</label>
                <input type="checkbox" checked="checked" name="view">
            </div>
            <button type="submit" class="btn btn-success">Оновити</button>
        </form>
    </div>
</div>

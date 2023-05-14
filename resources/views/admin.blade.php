@include('inc.header')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <form action="/admin/news_add" method="post" enctype="multipart/form-data">
                @csrf
                <div class="bg-secondary rounded text-light text-center">Форма додавання новини</div>
                <div class="mt-2">@include('inc.messages')</div>
                    @if($errors->any())
                        <div class="alert alert-danger mt-2">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <div class="form-group mt-4">
                    <label for="name">Назва новини</label>
                    <input type="text" name="name" placeholder="введіть назву" class="form-control">
                </div>
                <div class="form-group">
                    <input type="file" name="image" class="btn btn-link" id="file-input" accept="image/png, image/gif, image/jpeg, image/WEBP" multiple>
                </div>
                <div class="form-group">
                    <label for="name">Теги</label>
                    <input type="text" name="tags" placeholder="введіть назву" class="form-control">
                </div>
                <div class="form-group">
                    <label for="text">Текст новини</label>
                    <textarea name="text" placeholder="введіть текст" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="check">Активність статті</label>
                    <input type="checkbox" checked="checked" name="view">
                </div>
                <button class="btn btn-success" type="submit">Додати новину</button>
            </form>
        </div>
        <div class="col-md-6">
            <h1 class="text-center">Всі статті</h1>
            @foreach($data as $item)
            <div class="alert alert-secondary row">
                <div class="col-md-4">
                    <div class="admin-item-image">
                        <img src="/uploads/{{ $item->image }}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="item-created_at">{{ $item->created_at }}</div>
                    <div class="item-name">{{ $item->name }}</div>
                </div>
               <div class="form-button">
                   <a href="/admin/update/{{ $item->id }}">
                       <button class="btn btn-primary">Редагувати</button>
                   </a>
                   <a>
                       <button class="btn btn-danger ml-2" id="delete" data-element-id="{{ $item->id }}">Видалити</button>
                   </a>
               </div>
                <div class="btn-group btn-group-{{ $item->id }}">
                   <div class="col-md-12">
                       <a href="/admin/delete-news/{{ $item->id }}">
                           <button class="btn btn-danger btn-sm">Так</button>
                       </a>
                       <a>
                           <button class="btn btn-success btn-sm" id="btn_no">Ні</button>
                       </a>
                   </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#delete', function (){
        var id = $(this).attr('data-element-id')
        $('.form-button').css('display', 'none')
        $('.btn-group-'+id).css('display', 'block')
    })
    $(document).on('click','#btn_no', function(){
        $('.btn-group').css('display', 'none')
        $('.form-button').css('display', 'block')
    });
</script>

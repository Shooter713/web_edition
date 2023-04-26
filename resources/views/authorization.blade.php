@include('inc.header')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <form action="/registration/registration" method="post">
                @csrf
                <div class="bg-secondary rounded text-light text-center">Форма реєстрації</div>
                <div class="mt-2">@include('inc.messages')</div>
                <div class="form-group mt-4">
                    <label for="name">Введіть ім'я</label>
                    <input type="text" name="name" placeholder="Введіть ім'я" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Введіть email</label>
                    <input type="email" name="email" placeholder="Введіть email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Введіть пароль</label>
                    <input type="password" name="password" placeholder="Введіть пароль" class="form-control">
                </div>
                <button class="btn btn-success" type="submit">Реєстрація</button>
            </form>
        </div>
        <div class="col-md-6">
            <form action="/registration/login" method="post">
                @csrf
                <div class="bg-secondary rounded text-light text-center">Форма входу</div>
                <div class="form-group mt-4">
                    <label for="email">Введіть email</label>
                    <input type="email" name="email" placeholder="Введіть email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Введіть пароль</label>
                    <input type="password" name="password" placeholder="Введіть пароль" class="form-control">
                </div>
                <button class="btn btn-success" type="submit">Вхід</button>
            </form>
        </div>
    </div>
</div>
<div class="container">
    @if($errors->any())
        <div class="alert alert-danger mt-2">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

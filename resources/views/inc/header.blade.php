<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="/asset/css/css.css">
    <title>instrument</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">iMak91</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item ml-5">
                <a class="nav-link" href="/">Головна</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            @if(\Auth::user())
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Вихід</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/authorization">Вхід/реєстрація</a>
                </li>
            @endif
            @if(\Auth::user())
                <li class="nav-item">
                    <a class="nav-link" href="/admin">{{\Auth::user()->email}}</a>
                </li>
            @endif
        </ul>
        </ul>
    </div>
</nav>
</body>
</html>

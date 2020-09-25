<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

    </head>
    <body style="background-color:#ecf0f1;">
    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{route('home')}}">Unibook</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active text-muted" href="{{route('first.module')}}">Qiymət yazılması<span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link active text-muted" href="{{route('markTable')}}">Qiymət cədvəli<span class="sr-only">(current)</span></a>
    </div>
  </div>
  </nav>
  <!-- content -->
       @yield('content')
    </body>
</html>

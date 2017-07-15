<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
    <!--<link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet">-->
    <!--<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Old+Standard+TT" rel="stylesheet">
    <!--<link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">-->

    <!-- Styles -->
    <!-- Latest compiled and minified CSS -->
    <link  rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+          PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div style="padding-bottom: 55px;">
    <div class="title">
        {{ config('app.name') }}
    </div>

    <div class="navigation">
        @foreach($categories as $category)
            <div class="nav"><a class="@if(isset($currentCategory) && $currentCategory == $category->name) active @endif" href="/{{ $category->name }}">{{ $category->name }}</a></div>
        @endforeach
    </div>

    <div class="content">
        @yield('body')
    </div>
</div>
</body>
</html>

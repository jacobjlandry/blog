<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
        <!--<link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet">-->
        <!--<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">-->
        <link href="https://fonts.googleapis.com/css?family=Old+Standard+TT" rel="stylesheet">
        <!--<link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">-->

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                /*font-family: 'Raleway', sans-serif;*/
                /*font-family: 'Josefin Slab', serif;*/
                /*font-family: 'Lato', sans-serif;*/
                font-family: 'Old Standard TT', serif;
                /*font-family: 'Droid Sans', sans-serif;*/
                height: 100vh;
                width: 100%;
                margin: 0;
            }

            .navigation {
                display: flex;
                flex-direction: row;
                justify-content: center;
                border-top: 1px solid #ccc;
                border-bottom: 1px solid #ccc;
                margin-bottom: 15px;
            }

            .nav {
                padding: 15px;
                padding-left: 30px;
                padding-right: 30px;
            }
    
            .nav a {
                color: #000 !important;
                text-decoration: none;
            }

            .nav a.active {
                border-bottom: 2px solid #F00;
            }

            .content {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            
            .post {
                padding: 15px;
                text-align: left;
                width: 80%;
            }

            .post-header {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                padding-bottom: 5px;
            }

            .post-title {
                font-weight: bold;
            }
            .subcategory {
                font-weight: normal;
            }
            .subcategory a {
                color: #AAA;
                text-decoration: none;
            }

            .title {
                font-size: 65px;
                width: 100%;
                text-align: center;
                margin: 15px;
            }
        </style>
    </head>
    <body>
        <div>
            <div class="title">
                {{ env('APP_NAME') }}
            </div>

            <div class="navigation">
                @foreach($categories as $category)
                    <div class="nav"><a class="@if($post->category->name == $category->name) active @endif" href="/{{ $category->name }}">{{ $category->name }}</a></div>
                @endforeach
            </div>

            <div class="content">
                <div class="post">
                    <div class="post-header">
                        <div class="post-title">
                            {{ $post->title }}
                            @if($post->subcategory)
                                <span class="subcategory"><a href="/{{ $post->category->name }}/{{ $post->subcategory->name }}">[{{ $post->subcategory->name }}]</a></span> 
                            @endif
                        </div>
                        <div class="post-date">{{ $post->published_at->toDateString() }}</div>
                    </div>
                    {{ $post->body }}
                </div>
            </div>
        </div>
    </body>
</html>

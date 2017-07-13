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

            .separator {
                margin: 15px;
            }

            .post-date {
                width: 100%;
                text-align: center;
                color: #ccc;
                border-bottom: 1px solid #ccc; 
                line-height:0.1em; 
                margin-bottom: 15px;
            }
            .post-date span {
                background:#fff; 
                padding:0 10px;
            }
            .post-tags {
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div>
            <div class="title">
                {{ config('app.name') }}
            </div>

            <div class="navigation">
                @foreach($categories as $category)
                    <div class="nav"><a class="@if(isset($currentCategory) && $currentCategory == $category->name) active @endif" href="/{{ $category->name }}">{{ $category->name }}</a></div>
                @endforeach
            </div>

            <div class="content">
                @foreach($posts as $post)
                    @if(!$loop->first)
                        <div class="separator"></div>
                    @endif
                    <div class="post">
                        <div class="post-date"><span>{{ $post->published_at->format('l F j, Y') }}</span></div>
                        <div class="post-header">
                            <div class="post-title">
                                {{ $post->title }}
                                @if($post->subcategory)
                                    <span class="subcategory"><a href="/{{ $post->subcategory->category->name }}/{{ $post->subcategory->name }}">[{{ $post->subcategory->name }}]</a></span> 
                                    <span class="subcategory"><a href="/reader/{{ $post->subcategory->id }}/{{ $post->currentPosition() + 1 }}">[Reader View]</a></span>
                                @endif
                            </div>
                        </div>
                        {{ $post->body }}
                        <div class="post-tags">
                            @foreach($post->tags as $tag)
                                <a href="/tags/{{ $tag->name }}">#{{ $tag->name }}</a> &nbsp;
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>

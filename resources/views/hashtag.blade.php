<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        .nicknames {
            margin: 0 0 15px;
        }
        .nicknames > a {
            color: #636b6f;
            padding: 0 10px;
            font-size: 16px;
            letter-spacing: .05rem;
            text-decoration: underline;
        }
        .nicknames > span {
            margin: 0 10px;
        }
        .nicknames span:first-child {
            font-weight: bold;
            margin-bottom: 50px;
        }
        .nicsec {
            font-weight: bold;
            margin-bottom: 50px;
        }
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 100vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .m-b-md {
            position: relative;
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
        }
        form {
            margin-left: 10px;
            height: 100px;
        }
        #submit {
            /*font-family: 'Nunito', sans-serif;*/
            /*color: #636b6f;*/
            /*width: 260px;*/
            /*border: none;*/
            /*font-weight: 200;*/
            /*font-size: 84px;*/
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border: none;
            background: none;
            cursor: pointer;
        }
        input {
            font-family: 'Nunito', sans-serif;
            color: #636b6f;
            width: 300px;
            border: none;
            font-size: 84px;
        }
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        textarea:-webkit-autofill,
        textarea:-webkit-autofill:hover,
        textarea:-webkit-autofill:focus,
        select:-webkit-autofill,
        select:-webkit-autofill:hover,
        select:-webkit-autofill:focus {
            font-family: 'Nunito', sans-serif;
            -webkit-text-fill-color: #636b6f;
            font-weight: 200;
            font-size: 84px;
            transition: background-color 5000s ease-in-out 0s;
        }
        :-webkit-autofill::first-line,
        :-webkit-autofill,
        :-webkit-autofill:hover,
        :-webkit-autofill:focus,
        :-webkit-autofill:active {
            font-family: 'Nunito', sans-serif;
            -webkit-text-fill-color: #636b6f;
            font-size: 84px;
        }
        input:focus {
            outline: none;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Posts with hashtag <span style="font-weight: bold; color: black; padding-left: 15px;">{{$hashtag->hashtag}}</span>:
        </div>
        <div class="title m-b-md">
            Your posts:
            @foreach($hashtag->post as $posts)
                @if($posts->user == auth()->user())
                    <a style="padding: 0 10px; text-decoration: none;" href="{{route('other_username_post', [$posts->user->id, $posts->id])}}">{{$posts->content}}</a>
                @endif
            @endforeach
        </div>
        <div class="title m-b-md">
            Others posts:
            @foreach($hashtag->post as $posts)
            @if($posts->user != auth()->user())
                <a style="padding: 0 10px; text-decoration: none;" href="{{route('other_username_post', [$posts->user->id, $posts->id])}}">{{$posts->content}}</a>
            @endif
            @endforeach
        </div>

        @if (Route::has('login'))
            <div class="links">
                <a href="{{route('other_username', auth()->user()->id)}}">Back</a>
                @auth
                    {{--                            <a href="{{ route('logout') }}"--}}
                    {{--                               onclick="event.preventDefault();--}}
                    {{--                                                     document.getElementById('logout-form').submit();">--}}
                    {{--                                {{ __('Logout') }}--}}
                    {{--                            </a>--}}

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <input class="nicknames" id="submit" type="submit" value="Log out">
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>
</body>
</html>

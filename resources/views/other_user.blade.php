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
                width: 400px;
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
                    @if($User == auth()->user())
                        <span style="font-weight: bold">{{$User->name}}:</span>
                        <form action="{{route('add_post')}}" method="post" target="_self">
                            @csrf
                            <label for="content">
                                <input style="text-align: center" type="text" id="content" name="content" placeholder="(post)">
                            </label>
                            <label for="hashtags">
                                <input style="width: 500px" type="text" id="hashtags" name="hashtags" placeholder="(hashtags)">
                            </label>
                            <label for="submit">
                                <input type="submit" value="" style="display: none">
                            </label>
                        </form>
                    @else
                        {{$User->name}}
                    @endif
                </div>
                <div class="nicknames">
                    @if($User == auth()->user())
                        <span>Your posts:</span>
                    @else
                        <span>User posts:</span>
                    @endif
                    @foreach($user_posts as $post)
                            <a href="{{route('other_username_post', [$post->user->id, $post->id])}}">{{$post->content}}</a>
                    @endforeach
                </div>
                <div class="nicknames">
                        <span>Other users:</span>
                        @foreach($all_users as $user)
                            @if($user != $User)
                                <a href="{{route('other_username', $user->id)}}">{{$user->name}}</a>
                            @endif
                        @endforeach
                </div>
                    <div class="links">
                        <a href="../">Back</a>
                        @if (Route::has('login'))
                        @auth
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
{{--                                <input class="nicknames" id="submit" type="submit" value="Log out">--}}
                            </form>
                        @else
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                        @endif
                    </div>
            </div>
        </div>
    </body>
</html>

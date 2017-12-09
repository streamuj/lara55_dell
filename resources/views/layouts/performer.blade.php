<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css')}}" rel="stylesheet">
    <link href="{{ asset('css/emoji.css')}}" rel="stylesheet">
    <link href="{{ asset('css/emoji.css.map') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.1/skin/skin.min.css" rel="stylesheet">
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/emoji-picker/1.1.5/css/emoji.min.css" rel="stylesheet">--}}

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/ui-darkness/jquery-ui.css">
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>

    @yield('scripts')

    <style>
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel-body {
            overflow-y: scroll;
            height: 350px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">2001Live Performer Portal</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="/mainstage">Main Stage <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="/dressingRoom">Dressing Room</a>
                    <a class="nav-item nav-link" href="/allGirls">All Girls</a>
                    <a class="nav-item nav-link" href="/inHouse">Girls working now</a>


                </div>



            </div>
                @if(Auth::check())

                    @guest
                        <a class="nav-item nav-link" href="{{ route('login') }}">Login</a>
                        <a class="nav-item nav-link" href="{{ route('register') }}">Register</a>
                        @else


                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Messages</a>
                                    <a class="dropdown-item" href="#">Friends</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>

                            @endguest

{{--                    <a class="nav-item nav-link" href="/buyCredits">{{$credits}} Credits</a><--}}
                    <span class="navbar-text">Premium Member</span>
                    {{--@if($content)--}}
                        {{--{{$content}}--}}
                        {{--<a href="/friends" class="nav-item nav-link">Friend Request!</a>--}}
                    {{--@endif--}}


                @endif


        </nav>


        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.1/flowplayer.js"></script>
    <!-- load the Flowplayer hlsjs engine (light), including hls.light.js -->
    <script src="//releases.flowplayer.org/hlsjs/flowplayer.hlsjs.light.min.js"></script>
    {{--<script src="https://content.jwplatform.com/libraries/Cc5WPMR2.js"></script>--}}



</body>
</html>

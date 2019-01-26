<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }} - {{ env('APP_DESCRIPTION') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <!-- Styles -->
        <style>
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

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
                font-weight: bold;
            }

            .subtitle {
                font-size: 42px;
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
                margin-bottom: 30px;
            }

            #video_background {
                position: fixed;
                right: 0;
                bottom: 0;
                min-width: 100%;
                min-height: 100%;
                opacity: 0.1;
            }
        </style>
    </head>
    <body>
        <video autoplay muted loop id="video_background">
            <source src="videos/background.mp4" type="video/mp4">
        </video>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}"><i class="fas fa-home"></i> Home</a>
                    @else
                        <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <i class="fas fa-hand-holding-usd"></i> {{ env('APP_NAME') }}
                </div>

                <div class="subtitle m-b-md">
                    {{ env('APP_DESCRIPTION') }}
                </div>
            </div>
        </div>
    </body>
</html>

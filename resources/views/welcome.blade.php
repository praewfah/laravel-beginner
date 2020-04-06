<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        
        <!-- Styles -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
        
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Welcome</div>
            </div>
            <div class="row">
                <div class="col-md-5 col-md-offset-4">
                    <div class="col-md-5 text-right">
                        <a class="btn btn-link" href="{{ url('/register') }}">Register</a>
                    </div>
                    <div class="col-md-5 text-left">
                        <a class="btn btn-link" href="{{ url('/login') }}">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

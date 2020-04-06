<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Budget Tracker (LARAVEL)</title>
     
    <script type="text/javascript" src="{{ URL::asset('/js/jquery.min.js') }}"></script> 
    <script type="text/javascript" src="{{ URL::asset('/js/budget.js') }}"></script>
    
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ url('/') }}">Budget Tracker</a> 
            </div>
            
            @if (Auth::check())
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="{{ request()->is('budgets') ? 'active' : '' }}">
                        <a href="{{ url('/budgets') }}">
                            Budget
                        </a>
                    </li>
                    <li class="{{ request()->is('transections') ? 'active' : '' }}">
                        <a href="{{ url('/transections') }}">
                           Transaction
                        </a>
                    </li>
                    <li class="{{ request()->is('tasks') ? 'active' : '' }}">
                        <a href="{{ url('/tasks') }}">
                            Note
                        </a> 
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li> <a href="{{ url('/logout') }}">Logout</a></li>
                </ul>
            </div>
            @else
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li> <a href="{{ url('/login') }}">Login</a></li>
                    <li> <a href="{{ url('/register') }}">Register</a></li>
                </ul>
            </div>
            @endif
            
        </div>
    </nav>

    @yield('content')

    @if (isset($tasks) && count($tasks) > 0 && !(request()->is('tasks')))
    <div style="position: fixed; right: 30px; top: 72px ;width: 20rem;">
        <div class="panel  panel-info" style="width: 20rem;">
            <div class="panel-heading">Note :</div>
            <div class="panel-body">
                <ul class="list-unstyled">
                    @foreach ($tasks as $task)
                    <li>&bull; {{ $task->name }}</li>
                    @endforeach
                </ul>
                <a href="{{ url('/tasks') }}" class="pull-right">
                    Manage >>
                </a>
            </div>
      </div>
    </div>
    @endif
    
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>

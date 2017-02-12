<!-- app/views/apixu/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Apixu') }}</title>
    <link href="{{ elixir('css/font-awesome.min.css') }}" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir('css/style.min.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        .loader {
            border: 4px solid #f3f3f3; /* Light grey */
            border-top: 4px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div class="container">
    <div class="row">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('weather/forecast') }}">Show Forecast</a></li>
                <li><a href="{{ URL::to('weather/search') }}">Search</a></li>
                <li><a href="{{ URL::to('weather/history') }}">History</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<h1>{{ $weather['location']['name'] or 'Country' }} Weather</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

 @if (Session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@else
    <div id="my-alert" class="alert alert-warning hidden" role="alert">
    <label id="status">Status</label>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>name</th>    
            <th>region</th>
            <th>country</th>
            <th>lon</th>
            <th>lat</th>
            <th>tz_id</th>
            <th>localtime_epoch</th>
            <th>localtime</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$weather['location']['name']}}</td>
            <td>{{$weather['location']['region']}}</td>
            <td>{{$weather['location']['country']}}</td>
            <td>{{$weather['location']['lon']}}</td>
            <td>{{$weather['location']['lat']}}</td>
            <td>{{$weather['location']['tz_id']}}</td>
            <td>{{$weather['location']['localtime_epoch']}}</td>
            <td>{{$weather['location']['localtime']}}</td>
        </tr>
    </tbody>
</table>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            @foreach($weather['current']['condition'] as $k => $condition)
            <td>{{ $k  }}</td>
            @endforeach
        </tr>
    </thead>
    <tbody>
    <tr>
        @foreach($weather['current']['condition'] as $k => $condition)
            <td>{{ $condition  }}</td>
        @endforeach
    </tr>
    </tbody>
</table>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>temp_c</th>    
            <th>temp_f</th>
            <th>is_day</th>
            <th>temp_c</th>
            <th>wind_mph</th>
            <th>wind_kph</th>
            <th>wind_degree</th>
            <th>wind_dir</th>
            <th>pressure_mb</th>
            <th>pressure_in</th>
            <th>precip_mm</th>
            <th>humidity</th>
            <th>cloud</th>
            <th>feelslike_c</th>
            <th>feelslike_f</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$weather['current']['temp_c']}}</td>
            <td>{{$weather['current']['temp_f']}}</td>
            <td>{{$weather['current']['is_day']}}</td>
            <td>{{$weather['current']['temp_c']}}</td>
            <td>{{$weather['current']['wind_mph']}}</td>
            <td>{{$weather['current']['wind_kph']}}</td>
            <td>{{$weather['current']['wind_degree']}}</td>
            <td>{{$weather['current']['wind_dir']}}</td>
            <td>{{$weather['current']['pressure_mb']}}</td>
            <td>{{$weather['current']['pressure_in']}}</td>
            <td>{{$weather['current']['precip_mm']}}</td>
            <td>{{$weather['current']['humidity']}}</td>
            <td>{{$weather['current']['cloud']}}</td>
            <td>{{$weather['current']['feelslike_c']}}</td>
            <td>{{$weather['current']['feelslike_f']}}</td>
            
        </tr>
    </tbody>
</table>
</div>
</div>
</body>
<!-- Scripts -->
<script src="{{ elixir('js/app.min.js') }}"></script>
</html>
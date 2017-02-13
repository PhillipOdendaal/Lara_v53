<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Swagger') }}</title>
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
    <script src="{{ elixir('js/app.min.js') }}"></script>
</head>
<div id="app">
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
                        &nbsp;
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
    <div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div id="my-alert" class="alert alert-warning hidden" role="alert">
                    <label id="status">Status</label>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Dashboard - Swagger API</h3></div>
                
                <div id="my-alert-box" class="alert alert-info collapse" role="alert">
                    <button type="button" class="close" data-toggle="collapse" href="#my-alert-box">
                       <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                    <label type="text" class="btn-primary" id="status">Status</label>
                 </div>
                <!--
                @if (session('user'))
                    <div>{{ $attr->id }}</div>
                    <!--
                    @foreach ($user as $attr)
                        <div>{{ $attr->id }}</div>
                        <div>{{ $attr->name }}</div>
                    @endforeach
                    
                @endif
                -->
                <div class="panel-body">
                    <!-- Auth 
                        * TODO: Add Swagger profile and roles to Users
                        * GET TASK specific
                    -->
                    <form id="SwaggerLogin" class="form-horizontal" role="form" method="POST">
                        <div class="form-group hidden">
                            <div class="col-md-4 col-md-offset-2">
                                <label for="username">username</label>
                                <input type="text" name="username" value="admin1" id="username">
                            </div>
                        </div>
                        <div class="form-group hidden">
                            <div class="col-md-4 col-md-offset-2">
                                <label for="password">password</label>
                                <input type="text" name="password" value="admin1" id="password">
                            </div>
                        </div>
                        <input type="hidden" name="token" value="" id="token">
                    </form>
                    <!-- Projects -->
                    <div id="projectsContainer">
                            <!-- <a style="width:100%" class="btn btn-primary hidden" onclick="getProjects()" id="projects">Loading Projects...</a> -->
                            <!-- * TODO: Add WebSocs to get better concurrency control -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        var HTMLloader = [
            '<div class="col-md-4 col-md-offset-4" id="HTMLloader">',
            '<div class="loader" style="margin:0px auto"></div>',
            '<p style="text-align:center">Loading Projects...</p></div>'
        ].join("\n");

    /*----------------------------------------------------
     * DOM Functions
     ----------------------------------------------------*/
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/swagger/profile',
            type: 'GET',
            dataType: 'JSON',
            data: {},
            success: function(data) {

                if(data.code > 200){
                    $('#status').text('HTTP ('+data.code+') '+ data.body);
                    $('#my-alert').toggleClass("hidden");
                }else{
                    $('#status').text('Connected');
                    $('#token').val(data.token);
                    $("#my-alert").toggleClass("hidden");
                    $("#projects").toggleClass("hidden");
                    
                    getProjects();

                    $('#projectsContainer').html(HTMLloader);
                }
            },
            error: function(e) {
                $('#status').text('Error');
                $("#my-alert").toggleClass("hidden");
            }
        });
    });

    $("#show-my-alert, .close").click(function() {
        $("#my-alert").toggleClass("hidden");
    });
    
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus();
    });
    
    $( "#saveProject" ).click(function( event ) {
        event.preventDefault();
        saveProject();
    });

    /*----------------------------------------------------
     * Load all projects for this user
     ----------------------------------------------------*/
    function getProjects(){

        var token = $('#token').val();

        $.ajax({
            url: '/swagger/projects',
            type: 'GET',
            contentType: 'application/json; charset=utf-8',
            //dataType: 'text json', //Laravel object error
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'token':token},
            success: function(data) {

                if(data.code > 200){
                    $("#SwaggerLogin").toggleClass("hidden");
                    $("#my-alert").toggleClass("hidden").html('Error:'+data.code);
                }else{
                    $('#SwaggerLogin').toggleClass("hidden");
                    $('#projectsContainer').html(data);
                }
            },
            error: function(e) {
                $('#status').text('Error');
                $("#my-alert").toggleClass("hidden");
            }
        });
    }
    
    /*----------------------------------------------------
     * Load new project-form instance
     ----------------------------------------------------*/
    function addProjects(){
        $('.modal-body').text('Load Project form instance');
        
        $.ajax({
            //url: '/project',
            url: '/txProjects/create',
            type: 'GET',
            contentType: 'charset=utf-8',
            data: null,
            success: function(response) {
                $('.modal-body').html(response);
                $('.modal-title').html('Add new Project');
            },
            error: function(e) {
                $('#status').text('Error');
                $("#my-alert").toggleClass("hidden");
            }
        });
    }
    /*----------------------------------------------------
     * Save new project
     ----------------------------------------------------*/
    function saveProject(){
        var params = $('.SavetxProjects').serialize();
        
        $('.modal-body').append(HTMLloader);
        $('.SavetxProjects').toggle('hidden');
        
        $.ajax({
            url: '/txProjects/store',
            type: 'POST',
            contentType: 'charset=utf-8',
            data: params,
            success: function(response) {
                if(response.code > 200 && response.code < 300){
                    $('#HTMLloader').remove();
                    $('.modal-body').append('Project Successfuly added');
                }else{
                    $('.modal-body').append(response.body)
                }
            },
            error: function(e) {
                $('#status').text('Error');
                $("#my-alert").toggleClass("hidden");
            }
        });
        
    }
    </script>
    </div>
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-notice col-md-6 col-md-offset-2">
                    <p>Do you want to save changes you made to document before closing?</p>
                    <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
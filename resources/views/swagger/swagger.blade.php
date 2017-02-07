@extends('layouts.app')

@section('content')
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
                <div class="panel-heading">Dashboard - Swagger</div>
                
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
                <div class="panel-body">{{ Auth::user()->name }}
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
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-10">
                                <a type="" class="btn btn-primary hidden" onclick="getProjects()" id="projects">Show Projects</a>
                            </div>
                        </div>
                        <input type="hidden" name="token" value="" id="token">
                    </form>
                    <!-- Projects -->
                    <div class="projects"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
        success: function(data, code) {
            if(code > 200){
                $('#status').text('Disconnected');
            }else{
                $('#status').text('Connected');
                $('#token').val(data.token);
                $("#my-alert").toggleClass("hidden");
                $("#projects").toggleClass("hidden");
            }
        },
        error: function(e) {
            $('#status').text('Connected');
            $("#my-alert").toggleClass("hidden");
        }
    });
});

$("#show-my-alert, .close").click(function() {
    $("#my-alert").toggleClass("hidden");
});

function getProjects(){
    console.log('getProjects');
    var token = $('#token').val();
    
    $.ajax({
        url: '/swagger/projects',
        type: 'GET',
        dataType: 'JSON',
        data: token,
        success: function(data, code) {
            console.log(code);
            console.log(data);
            if(code > 200){
                $('#status').text(data);
                $("#SwaggerLogin").toggleClass("hidden");
            }else{
                $('#SwaggerLogin').toggleClass("hidden");
                
            }
        },
        error: function(e) {
            console.log(e);
            $('#status').text('Error');
            $("#my-alert").toggleClass("hidden");
        }
    });
}
</script>
@endsection
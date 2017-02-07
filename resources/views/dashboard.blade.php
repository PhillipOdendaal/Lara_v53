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
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">Statistics about the Site</div>
                
                <div class="panel-body">
                    <a class="btn btn-primary" href="{{ url('/swagger/index') }}">Load Swagger-API</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

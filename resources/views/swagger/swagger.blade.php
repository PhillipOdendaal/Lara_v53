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
                <div class="panel-heading">Dashboard - Swagger Loaded</div>
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
                <div class="panel-body">{{ Auth::user()->name }}</div>
                
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
    url: '/profile/update',
    type: 'POST',
    dataType: 'JSON',
    data: $('form#profile-form').serialize()
});

});
</script>
@endsection
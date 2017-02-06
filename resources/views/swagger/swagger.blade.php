@extends('layouts.app')

@section('content')
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
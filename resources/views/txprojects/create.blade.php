<!-- app/views/projects/create.blade.php -->

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{ Form::open(array('url' => 'txProjects.store', 'class' => 'SavetxProjects')) }}
        {{ Form::hidden('txtoken', Input::old('txtoken'), array('class' => 'hidden','id' => 'txtoken')) }}
        
    <div class="form-group">
        {{ Form::label('title', 'Title', ['class' => 'awesome']) }}
        {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
    </div>
        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif

    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('start_date', 'Start Date') }}
        {{ Form::date('start_date', Input::old('start_date'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('end_date', 'End Date') }}
        {{ Form::date('end_date', Input::old('end_date'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('billable', 'Billable') }}
        {{ Form::select('billable', array('1' => 'Yes', '0' => 'No'), Input::old('billable'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('is_active', 'Active') }}
        {{ Form::select('is_active', array('1' => 'Yes', '0' => 'No'), Input::old('is_active'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Start the Project', array('class' => 'btn btn-primary', 'id' => 'saveProject')) }}

{{ Form::close() }}

</div>
<script>
    /*----------------------------------------------------
     * DOM Functions
     ----------------------------------------------------*/
    $( "#saveProject" ).click(function( event ) {
        event.preventDefault();
        var txTokenVal = $('#token').val()
        $('#txtoken').val(txTokenVal);
        saveProject();
    });
</script>

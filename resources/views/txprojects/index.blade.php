<!-- app/views/projects/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link href="{{ elixir('css/font-awesome.min.css') }}"/>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir('css/style.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('txProjects') }}">Project Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('txProjects') }}">View All Swagger Projects</a></li>
        <li><a href="{{ URL::to('txProjects/create') }}">Create a Swagger Project</a>
    </ul>
</nav>

<h1>All the Projects</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Transaction ID</td>
            <td>Description</td>
            <td>Status</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($projects as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->txid }}</td>
            <td>{{ $value->txDescriprion }}</td>
            <td>{{ $value->status }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>
                <a class="btn btn-small btn-success" href="{{ URL::to('txProjects/' . $value->id) }}">Show this Transaction</a>

                <a class="btn btn-small btn-info" href="{{ URL::to('txProjects/' . $value->id . '/edit') }}">Edit this Transaction</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
<!-- Scripts -->
<script src="{{ elixir('js/app.min.js') }}"></script>
</html>
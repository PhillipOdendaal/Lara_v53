<table class="table table-striped project-table">
<!-- Table Headings -->
<thead>
    <th colspan="4" style="width:80%">Projects</th>
    <th colspan="2">Controls</th>
</thead>
@if (count($projects) > 0)
<!-- Table Body -->
<tbody>
    @foreach ($projects as $project)
        <tr>
            <form action="{{ url('swagger/tasks/'.$project->pk) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('getMethod') }}
            <!-- Vehicle Name -->
            <td class="table-text" colspan="4">
                <div>{{ $project->title }}</div>
            </td>
            <!-- Edit Button -->
            <td>
                <button type="submit" id="update-vehicle-{{ $project->pk }}" class="btn btn-default">
                    <i class="fa fa-btn fa-plus"></i>Update
                </button>
            </td>
            <!-- Delete Button -->
            <td>
                <button type="submit" id="delete-vehicle-{{ $project->pk }}" class="btn btn-danger">
                    <i class="fa fa-btn fa-trash"></i>Delete
                </button>
            </td>
        </tr>
        </form>
    @endforeach
</tbody>
@endif
</table>
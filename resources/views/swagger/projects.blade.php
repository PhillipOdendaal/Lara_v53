<table class="table table-striped project-table">
<!-- Table Headings -->
<thead>
    <th colspan="6">Projects</th>
    <th colspan="3">Controls</th>
</thead>
@if (count($projects) > 0)
<!-- Table Body -->
<tbody>
    <tr>
        <td class="table-text">Title</td>
        <td class="table-text">Description</td>
        <td class="table-text">Start date</td>
        <td class="table-text">End date</td>
        <td class="table-text">Billable</td>
        <td class="table-text">Active</td>
        <td class="table-text"></td>
        <td class="table-text"></td>
        <td class="table-text"></td>
    </tr>
    @foreach ($projects as $project)
        <tr>
            <form action="{{ url('swagger/tasks/'.$project->pk) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('getMethod') }}
            <td class="table-text">
                <div>{{ $project->title }}</div>
            </td>
            <td class="table-text">
                <div>{{ $project->description }}</div>
            </td>
            <td class="table-text">
                <div>{{ $project->start_date }}</div>
            </td>
            <td class="table-text">
                <div>{{ $project->end_date }}</div>
            </td>
            <td class="table-text">
                <div>@if($project->is_billable == true)
                    Yes
                @else
                    No
                @endif</div>
            </td>
            <td class="table-text">
                <div>@if($project->is_active == true)
                    Yes
                @else
                    No
                @endif</div>
            </td>
            <!-- Edit Button -->
            <td>
                <button type="submit" id="update-project-{{ $project->pk }}" class="btn btn-default">
                    <i class="fa fa-btn fa-plus"></i> Edit
                </button>
            </td>
            <!-- Delete Button -->
            <td>
                <button type="submit" id="delete-project-{{ $project->pk }}" class="btn btn-danger">
                    <i class="fa fa-btn fa-trash"></i> Delete
                </button>
            </td>
            <!-- View Tasks Button -->
            <td>
                <button type="submit" id="tasks-{{ $project->pk }}" class="btn btn-default">
                    <i class="fa fa-btn"></i> Tasks
                </button>
            </td>
        </tr>
        </form>
    @endforeach
    <tr>
        <td colspan="8"></td>
        <td><a href="#myModal" role="button" class="btn btn-large btn-primary" data-toggle="modal" onclick="addProjects()">Add Project</a>
        </td>
    </tr>
</tbody>
@endif
</table>
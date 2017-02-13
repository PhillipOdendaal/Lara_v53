<table class="table table-striped project-table">
<!-- Table Headings -->
<thead>
    <th colspan="6">Projects</th>
    <th colspan="1">Controls</th>
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
    </tr>
    @foreach ($projects as $project)
    <form action="{{ url('swagger/tasks/'.$project->pk) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('getMethod') }}
        <tr>
            <td class="table-text">
                <div ><a href="#myModal" role="button" data-toggle="modal" onclick="showTasks({{ $project->pk }})">{{ $project->title }}</a></div>
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
            <td class="table-text hidden">
                <div class="form-group hidden" id="taskSet-{{ $project->pk }}">
                <table class="table table-striped project-table">
                    <thead>
                        <th>Title</th>
                        <th>Due Date</th>
                        <th>Estimated Hours</th>
                    </thead>
                    <tbody>
                    @foreach ($project->task_set as $task)
                    <tr id="{{ $task->id }}">
                        <td class="table-text">
                            <span class="text-info small">{{ $task->project_data->title }}</span><br>
                            <input type="text" name="title" value="{{ $task->title }}" id="title">
                        </td>
                        <td class="table-text">
                            <span class="text-info small">&nbsp;</span><br>
                            <input type="date" name="due_date" value="{{ $task->due_date }}" id="due_date">
    
                        </td>
                        <td class="table-text">
                            <span class="text-info small">&nbsp;</span><br>
                            <input type="text" name="estimated_hours" value="{{ $task->estimated_hours }}" id="estimated_hours">
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </td>
            <td>
                <!-- Edit Button -->
                <button type="submit" id="update-project-{{ $project->pk }}" class="btn btn-default">
                    <i class="fa fa-btn fa-plus"></i> Edit
                </button>
                <!-- Delete Button -->
                <button type="submit" id="delete-project-{{ $project->pk }}" class="btn btn-danger">
                    <i class="fa fa-btn fa-trash"></i> Delete
                </button>
            </td>
        </tr>
        </form>
    @endforeach
    <tr>
        <td colspan="6">{{@count($projects)}} projects</td>
        <td style="text-align: right;"><a href="#myModal" role="button" class="btn btn-large btn-primary" data-toggle="modal" onclick="addProjects()">Add Project</a>
        </td>
    </tr>
</tbody>
@endif
</table>
        
<script type="text/javascript">
    $('.date').datepicker({  
           format: 'yyyy-mm-dd'  
        });
    $(function() {
        $( "#datepicker" ).datepicker();
    });
    /*----------------------------------------------------
     * Load new project-form instance
     ----------------------------------------------------*/
    function showTasks(args){
        $('.modal-body').text('');
        var content = $('#taskSet-'+args).html();
        var modal = $('.modal-body');
        $('.modal-title').text(' ProjectTasks');
        $('.modal-dialog').addClass(' modal-lg');
        $(content).appendTo(modal).removeClass("hidden"); 
        $('.modal-footer').addClass(' hidden');
        $('.modal-notice').addClass(' hidden');
    }
</script>
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use EllipseSynergie\ApiResponse\Contracts\Response;
use App\Project;
use App\Transformer\ProjectTransformer;

class ProjectController extends Controller
{
    protected $response;
 
    public function __construct(Response $response)
    {
        $this->response = $response;
    }
 
    public function index()
    {
        //Get all project
        $projects = Project::paginate(15);
        // Return a collection of $projects with pagination
        return $this->response->withPaginator($projects, new  ProjectTransformer());
    }
 
    public function show($id)
    {
        //Get the project
        $project = Project::find($id);
        if (!$project) {
            return $this->response->errorNotFound('Project Not Found');
        }
        // Return a single project
        return $this->response->withItem($project, new  ProjectTransformer());
    }
 
    public function destroy($id)
    {
        //Get the project
        $project = Project::find($id);
        if (!$project) {
            return $this->response->errorNotFound('Project Not Found');
        }
 
        if($project->delete()) {
             return $this->response->withItem($project, new  ProjectTransformer());
        } else {
            return $this->response->errorInternalError('Could not delete a project');
        }
 
    }
 
    public function store(Request $request)  {
        if ($request->isMethod('put')) {
            //Get the project
            $project = Project::find($request->project_id);
            if (!$project) {
                return $this->response->errorNotFound('Project Not Found');
            }
        } else {
            $project = new Project;
        }
 
        $project->id = $request->input('project_id');
        $project->description = $request->input('description');
        $project->user_id =  1; //$request->user()->id;
 
        if($project->save()) {
            return $this->response->withItem($project, new  ProjectTransformer());
        } else {
             return $this->response->errorInternalError('Could not updated/created a project');
        }
 
    }
}

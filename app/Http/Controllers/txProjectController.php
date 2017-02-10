<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use EllipseSynergie\ApiResponse\Contracts\Response;
use App\Transformer\txProjectTransformer;
use App\txProject;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
//use App\Http\Requests;
//use Illuminate\View\View;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client;

class txProjectController extends Controller
{
    protected $response;
    //protected $request;
    /**
    public function __construct(Response $response)
    {
        $this->response = $response;
    }
    */
    //public function __construct(Response $response,Request $request)
    public function __construct(Response $response)
    {
        $this->response = $response;
        //$this->request = $request;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the transacted projects
        $projects = txProject::all();
        
        // load the view and pass the transactions
        return view('txprojects.index')
            ->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('txprojects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $headers = [
                'content-type' => 'application/json',
                'Authorization' => $get_array['txtoken']
            ];
        
            
        $data = [
            'title' => $get_array['title'],
            'description' => $get_array['description'],
            'start_date' => $get_array['start_date'],
            'end_date' => $get_array['end_date'],
            'billable' => $get_array['billable'],
            'is_active' => $get_array['is_active'],
            'task_set' => [], //Need mapping
            'resource_set' => [], //Need mapping
        ];

        //$client = new Client(); // Start new endpoint

        $endpoint = $client->post('http://projectservice.staging.tangentmicroservices.com:80/api/v1/projects/', 
                [
                    'headers' => $headers, 
                    'form_params' => json_encode($data),
                ],''
            );
            
        $client = new Client([
            'base_uri' => API_URI,
            'cookies' => $this->jar
        ]);
        ); // Start new endpoint
        
        $this->guzzle_instance = new \GuzzleHttp\Client([
            'base_uri' => API_URI,
            'cookies' => $this->jar
        ]);
        return $this;
    }
    public function store2(Request $request)
    {
        /**
         * Validator always/defaults fails for some reason ???
        $messages = [
            'required' => 'The :attribute field is required.',
        ];

        $validator = Validator::make($request->all(), [
            'title'         => 'required|max:255',
            'description'   => 'required|max:255',
            //'start_date'    => 'required|date|after:tomorrow',
            //'end_date'    => 'required|date|after:start_date',
            'billable'     => 'required|boolean',
            'is_active'     => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect('txProjects/create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
        */

            
            $input = $request->getContent();
            parse_str($input, $get_array);
            
            // Additional snapshot object to save transactions when saving projects
            //$project = new txProject;
            //$snapshot = json_encode($get_array);
            /*
            $project->_token = $get_array['_token'];
            $project->txid = $get_array['txtoken'];
            $project->title = $get_array['title'];
            $project->description = $get_array['description'];
            $project->start_date = $get_array['start_date'];
            $project->end_date = $get_array['end_date'];
            $project->billable = $get_array['billable'];
            $project->is_active = $get_array['is_active'];            
            */
            //$project->txDescription = $get_array['title'].' - '.$get_array['description'];
            //$project->snapshot = $snapshot;
            //$project->status = 0;
            //if($project->save()) {
                //return $this->response->withItem($project, new  txProjectTransformer());
            //} else {
                //return $this->response->errorInternalError('Could not updated/created a project');
            //}
            
            $headers = [
                'content-type' => 'application/json',
                'Authorization' => $get_array['txtoken']
            ];
            
            $data = [
                'title' => $get_array['title'],
                'description' => $get_array['description'],
                'start_date' => $get_array['start_date'],
                'end_date' => $get_array['end_date'],
                'billable' => $get_array['billable'],
                'is_active' => $get_array['is_active'],
                'task_set' => [], //Need mapping
                'resource_set' => [], //Need mapping
            ];

            $client = new Client(); // Start new endpoint

            $endpoint = $client->post('http://projectservice.staging.tangentmicroservices.com:80/api/v1/projects/', 
                    [
                        'headers' => $headers, 
                        'form_params' => json_encode($data),
                    ],''
                );

            //echo $request->getStatusCode();
            //echo $request->getHeaders()['Content-Type']; // PHP 5.4
            //echo $request->getBody();
            
           // dd($request->getBody());

            $reply = $endpoint->getBody();
            
            Session::flash('message', 'Successfully created txProject!');
            
            return redirect('txProjects.create')->with('status', $reply);
        //}

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    
    protected function processRequest($method, $sub_uri, $body = null, $headers = null)
    {
        
        try {
             $this->response = $this->guzzle_instance->request($method, $sub_uri, array(
            'headers' => $headers,
            'body' => $body
            ));    
       }
       catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $result =  $response->getBody();

            //do something with it....

       }
    }

}

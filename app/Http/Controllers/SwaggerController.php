<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
//use Zjango\Laracurl\Facades\Laracurl;
use App\Swagger;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class SwaggerController extends Controller
{
    protected $request;
    //protected $curl;    
    //protected $client;
    
    /**
     * The URL the request is sent to.
     * 
     * @var string
     */
    private $url = '';
   
    /**
     * @param Requests $request
     * @param cURL $curl
     */
    //public function __construct(Requests $request, Laracurl $curl)
    //public function __construct(Laracurl $curl)
    //public function __construct(Request $request, Client $client)
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function load()
    {
        return view('swagger.index')->with('status', 'Swagger Loaded');
    }
    
    public function index()
    {
        $token = '';
        
        $headers = [
            'Accept' => 'application/json'
        ];
        
        $data = [
                'username' => 'admin1',
                'password' => 'admin1',
            ];

        $client = new Client();
        
        $request = $client->post('http://userservice.staging.tangentmicroservices.com:80/api-token-auth/', 
                [
                    'headers' => $headers, 
                    'json' => $data,
                ],$token
            );
        
        //echo $request->getStatusCode();
        //echo $request->getHeaders()['Content-Type']; // PHP 5.4
        //echo $request->getBody();
        
        return $request->getBody();
    }
    
    public function show(Request $request){
        
        $token = $request->input('token');

        $headers = [
            'content-type' => 'application/json',
            'Authorization' => $token
        ];
        
        $client = new Client();
        
        $response = $client->get('http://projectservice.staging.tangentmicroservices.com:80/api/v1/projects/', 
                [
                    'headers' => $headers
                ],''
            );
        
        $projects = json_decode($response->getBody());
        $merge = '';
        
        if($request->ajax()) {
            //return view('swagger.projects', ['projects' => json_decode($response->getBody())], $merge);
            //return view('swagger.projects', ['projects' => json_decode($response->getBody())]);
            return view('swagger.projects')->with('projects', json_decode($response->getBody()));
        }else{
            return response()
                ->view('swagger.projects', ['projects' => json_decode($response->getBody())], 200)
                ->header('Content-Type', 'json');
            /*
             * return response()->json([
             *      'view' => view('swagger.projects', ['projects' => json_decode($response->getBody())])->render()
             * ]);
             */
        }
        
    }
    
    public function destroy($id){}
    
    public function store(Request $request){}
}

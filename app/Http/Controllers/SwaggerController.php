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
    
    public function show(){
        //print_r($this->request);
    //public function show($token){
        /*
        $headers = [
            'content-type' => 'application/json',
            'Authorization' => $token
        ];
        
        $client = new Client();
        
        $request = $client->post('http://userservice.staging.tangentmicroservices.com:80/api-token-auth/', 
                [
                    'headers' => $headers, 
                    'json' => $data,
                ],''
            );
        return $request->getBody();
         *
         */
    }
    
    public function destroy($id){}
    
    public function store(Request $request){}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
//use Zjango\Laracurl\Facades\Laracurl;
use App\Swagger;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;


use App\ApixuWeather;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SwaggerController extends Controller
{
    protected $request;
    protected $response;
    
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
        $swagger = DB::table('txrequests')->where('tx_name', 'Swagger Login')->first();
        
        $client = new Client();
        
        try {
            $this->response = $client->post(str_replace('"', "",$swagger->tx_path), 
                [
                    'headers' => [$swagger->tx_head],
                    'json' => [$swagger->tx_payload],
                ],$token
            );

        }catch(\GuzzleHttp\Exception\ClientException $e) {
            
            $getResponse = json_decode($e->getResponse()->getBody(), true);
            $responseCode = $e->getResponse()->getStatusCode();

            return ['code' => $responseCode, 'body' => $getResponse['non_field_errors'][0]];
        }
        $token = $this->response->getBody();

        return $token;
    }
    
    public function show(Request $posted){
        
        $value = '';
        $token = $posted->input('token');
        $headers = [
            'content-type' => 'application/json',
            'Authorization' => $token
        ];
        $url = 'http://projectservice.staging.tangentmicroservices.com:80/api/v1/projects/';
        
        $client = new Client();

        try {
            $this->response = $client->post($url, $headers, $value);
            $responseCode = $response->getStatusCode();
            $responseBody = $this->response->getBody();
            
            if($request->ajax()) {
                return view('swagger.projects', ['code' => $responseCode])->with('projects', json_decode($responseBody));
            }else{
                return response()
                ->view('swagger.projects', ['projects' => json_decode($responseBody)], $responseCode)
                ->header('Content-Type', 'json');
            }

        }catch(\GuzzleHttp\Exception\ClientException $e) {
            $getResponse = json_decode($e->getResponse()->getBody(), true);
            $responseCode = $e->getResponse()->getStatusCode();

            return ['code' => $responseCode, 'body' => $getResponse['non_field_errors'][0]];
        }

    }
    
    public function destroy($id){}
    
    public function store(Request $request){}
}

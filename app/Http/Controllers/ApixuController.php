<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
//use GuzzleHttp\Psr7\Request;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;


use App\ApixuWeather;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApixuController extends Controller
{
    protected $request;
    protected $response;
 
    /**
     * @param Requests $request
     * @param cURL $curl
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Client $url, query $data
     * @param key $tx_head, q $tx_payload
     */
    public function index()
    {
        $ApixuWeather = DB::table('txrequests')->where('tx_name', 'Apixu Current')->first();
        
        //$url = $ApixuWeather->tx_path;
        //$headers = str_replace("'", "", $ApixuWeather->tx_head);
        //$data = str_replace("'", "", $ApixuWeather->tx_payload);
        //print('Headers:'.preg_replace("/[\[(.)\]]/", "", str_replace('"', "'", $headers)));

        $client = new Client();

        try {
            $response = $client->request('GET', str_replace('"', "",$ApixuWeather->tx_path), [
                'query' => ['key' => $ApixuWeather->tx_head, 'q' => $ApixuWeather->tx_payload]
            ]);
            
        }catch(\GuzzleHttp\Exception\ClientException $e) {
            $getResponse = json_decode($e->getResponse()->getBody(), true);
            $responseCode = $e->getResponse()->getStatusCode();

            return ['code' => $responseCode, 'body' => $getResponse['error']['message']];
        }
        
        $weather = json_decode($response->getBody(), true);
        //dd($leads);
        
        //return json_decode($response->getBody(), true);
        return view('apixu.index', ['message' => 'success'])->with('weather', $weather);
    }
    
    public function show(Request $posted){}
    
    public function store(Request $request){}
}

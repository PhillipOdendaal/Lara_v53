<?php

use Illuminate\Database\Seeder;

class TxRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $int = mt_rand(1262055681,1262055681);
        $randomInt = rand (0,10);
        $randomStr = str_random(100);
        $randomFloat = rand(0, 10) / 10;
        $randomDate = date("Y-m-d",$int);
        $randomBool = (bool)rand(0,1);
        
        DB::table('txrequests')->insert([
            'tx_name' => 'Swagger Login',
            'tx_description' => 'Authenticate Swagger API',
            'tx_path' => '"http://userservice.staging.tangentmicroservices.com:80/api-token-auth/"',
            'tx_head' => '"Accept" => "application/json"',
            'tx_payload' => '"username":"jacob.zuma","password":"tangent"',
            'status' => $randomBool,
        ]);
        
        DB::table('txrequests')->insert([
            'tx_name' => 'Swagger Projects',
            'tx_description' => 'Get Projects from Swagger API',
            'tx_path' => '"http://projectservice.staging.tangentmicroservices.com:80/api/v1/projects/"',
            'tx_head' => '"content-type" => "application/json","Authorization" => "$token"',
            'tx_payload' => '',
            'status' => $randomBool,
        ]);
        /**
        DB::table('txrequests')->insert([
            'tx_name' => 'Apixu Current',
            'tx_description' => 'Current Weather',
            'tx_path' => '"https://api.apixu.com/v1/current.json"',
            'tx_head' => '["content-type" => "application/json","key" => "dd44feba5dce4bf2ab6164025171202"]',
            'tx_payload' => '{q=Paris}',
            'status' => $randomBool,
        ]);
        
        DB::table('txrequests')->insert([
            'tx_name' => 'Apixu Forecast',
            'tx_description' => 'Forecast Weather',
            'tx_path' => '"http://api.apixu.com/v1/forecast.json"',
            'tx_head' => '["content-type" => "application/json","key" => "dd44feba5dce4bf2ab6164025171202"]',
            'tx_payload' => '{q=Paris}',
            'status' => $randomBool,
        ]);
         *
         */
    }
}

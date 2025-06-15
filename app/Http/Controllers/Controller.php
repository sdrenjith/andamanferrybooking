<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function makApiCall($endPoint=NULL, $param=NULL)
    {
        try {
            $response = Http::timeout(50)->withHeaders([
                'Mak_Authorization' => env('MAK_TOKEN'),
                'Accept' => 'application/json'
            ])
            ->withoutVerifying()
            ->post(env('MAK_API_URL') . $endPoint, $param);
            // var_dump($response);die;
            $data = json_decode($response);
            return $data;

        } catch (\Illuminate\Http\Client\RequestException $e) {
            $data = [];
            return $data;
        }

        // $data = json_decode($response);
        // return $data;
    }

    public function nautikaApiCall($endPoint=NULL, $param=NULL)
    {
        $authParam = array('userName' => env('NAUTIKA_API_USERNAME'), 'token' => env('NAUTIKA_TOKEN'));
        $paramAll = array_merge($param, $authParam);

        try {
            $response = Http::withHeaders([
                'debug' => true, // Custom header to trigger debugging
                'Accept' => 'application/json'
            ])->timeout(20)->withoutVerifying()->post(env('NAUTIKA_API_URL') . $endPoint, $paramAll);

            if (request()->ip() == "103.170.183.151") {
                dd($response);
            }
            $data = json_decode($response);
            return $data;

        } catch (\Illuminate\Http\Client\RequestException $e) {
            $data = [];
            return $data;
        }
    }

    public function greenOceanApiCall($endPoint=NULL, $param=NULL)
    {
        try {
            $response = Http::timeout(50)->withHeaders([
                'Accept' => 'application/json'
            ])
            ->withoutVerifying()
            ->post(env('GREEN_OCEAN_API_URL') . $endPoint, $param);
            // var_dump($response);die;
            $data = json_decode($response);
            return $data;

        } catch (\Illuminate\Http\Client\RequestException $e) {
            $data = [];
            return $data;
        }
    }

    public function getHashKey($postData, $private_key,$hash_sequence)
    {
        $hash_sequence_array = explode('|', $hash_sequence);
        $hash = null;
        foreach ($hash_sequence_array as $value) {

            if(isset($postData[$value])){
                $data = $postData[$value];
            }else{
                $data = "";
            }

            if(is_array($data)){
                $data = implode(",",$data);
            }

            $hash .= $data;
            $hash .= '|';
        }
        $hash .= $private_key;
        return strtolower(hash('sha512', $hash));
    }
}

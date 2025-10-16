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
            $response = Http::timeout(30)->connectTimeout(10)->withHeaders([
                'Mak_Authorization' => env('MAK_TOKEN'),
                'Accept' => 'application/json'
            ])
            ->withoutVerifying()
            ->post(env('MAK_API_URL') . $endPoint, $param);
            // var_dump($response);die;
            $data = json_decode($response);
            return $data;

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            // Log the connection error for debugging
            \Log::warning('Makruzz API Connection Error: ' . $e->getMessage(), [
                'endpoint' => $endPoint,
                'url' => env('MAK_API_URL') . $endPoint
            ]);
            $data = new \stdClass();
            $data->data = [];
            return $data;
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // Log the request error for debugging
            \Log::warning('Makruzz API Request Error: ' . $e->getMessage(), [
                'endpoint' => $endPoint,
                'url' => env('MAK_API_URL') . $endPoint
            ]);
            $data = new \stdClass();
            $data->data = [];
            return $data;
        } catch (\Exception $e) {
            // Log any other errors
            \Log::error('Makruzz API General Error: ' . $e->getMessage(), [
                'endpoint' => $endPoint,
                'url' => env('MAK_API_URL') . $endPoint
            ]);
            $data = new \stdClass();
            $data->data = [];
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
            ])->timeout(30)->connectTimeout(10)->withoutVerifying()->post(env('NAUTIKA_API_URL') . $endPoint, $paramAll);

            if (request()->ip() == "103.170.183.151") {
                dd($response);
            }
            $data = json_decode($response);
            return $data;

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            // Log the connection error for debugging
            \Log::warning('Nautika API Connection Error: ' . $e->getMessage(), [
                'endpoint' => $endPoint,
                'url' => env('NAUTIKA_API_URL') . $endPoint
            ]);
            $data = new \stdClass();
            $data->data = [];
            return $data;
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // Log the request error for debugging
            \Log::warning('Nautika API Request Error: ' . $e->getMessage(), [
                'endpoint' => $endPoint,
                'url' => env('NAUTIKA_API_URL') . $endPoint
            ]);
            $data = new \stdClass();
            $data->data = [];
            return $data;
        } catch (\Exception $e) {
            // Log any other errors
            \Log::error('Nautika API General Error: ' . $e->getMessage(), [
                'endpoint' => $endPoint,
                'url' => env('NAUTIKA_API_URL') . $endPoint
            ]);
            $data = new \stdClass();
            $data->data = [];
            return $data;
        }
    }

    public function greenOceanApiCall($endPoint=NULL, $param=NULL)
    {
        try {
            $response = Http::timeout(30)->connectTimeout(10)->withHeaders([
                'Accept' => 'application/json'
            ])
            ->withoutVerifying()
            ->post(env('GREEN_OCEAN_API_URL') . $endPoint, $param);
            // var_dump($response);die;
            $data = json_decode($response);
            return $data;

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            // Log the connection error for debugging
            \Log::warning('Green Ocean API Connection Error: ' . $e->getMessage(), [
                'endpoint' => $endPoint,
                'url' => env('GREEN_OCEAN_API_URL') . $endPoint
            ]);
            $data = new \stdClass();
            $data->data = [];
            return $data;
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // Log the request error for debugging
            \Log::warning('Green Ocean API Request Error: ' . $e->getMessage(), [
                'endpoint' => $endPoint,
                'url' => env('GREEN_OCEAN_API_URL') . $endPoint
            ]);
            $data = new \stdClass();
            $data->data = [];
            return $data;
        } catch (\Exception $e) {
            // Log any other errors
            \Log::error('Green Ocean API General Error: ' . $e->getMessage(), [
                'endpoint' => $endPoint,
                'url' => env('GREEN_OCEAN_API_URL') . $endPoint
            ]);
            $data = new \stdClass();
            $data->data = [];
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

    // Fast API call methods with shorter timeouts for better performance
    public function nautikaApiCallFast($endPoint=NULL, $param=NULL)
    {
        $authParam = array('userName' => env('NAUTIKA_API_USERNAME'), 'token' => env('NAUTIKA_TOKEN'));
        $paramAll = array_merge($param, $authParam);

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])->timeout(10)->connectTimeout(5)->withoutVerifying()->post(env('NAUTIKA_API_URL') . $endPoint, $paramAll);

            $data = json_decode($response);
            return $data;

        } catch (\Exception $e) {
            $data = new \stdClass();
            $data->data = [];
            return $data;
        }
    }

    public function makApiCallFast($endPoint=NULL, $param=NULL)
    {
        try {
            $response = Http::timeout(10)->connectTimeout(5)->withHeaders([
                'Mak_Authorization' => env('MAK_TOKEN'),
                'Accept' => 'application/json'
            ])
            ->withoutVerifying()
            ->post(env('MAK_API_URL') . $endPoint, $param);
            
            $data = json_decode($response);
            return $data;

        } catch (\Exception $e) {
            $data = new \stdClass();
            $data->data = [];
            return $data;
        }
    }

    public function greenOceanApiCallFast($endPoint=NULL, $param=NULL)
    {
        try {
            $response = Http::timeout(10)->connectTimeout(5)->withHeaders([
                'Accept' => 'application/json'
            ])
            ->withoutVerifying()
            ->post(env('GREEN_OCEAN_API_URL') . $endPoint, $param);
            
            $data = json_decode($response);
            return $data;

        } catch (\Exception $e) {
            $data = new \stdClass();
            $data->data = [];
            return $data;
        }
    }

    // Ultra-fast API call methods with 5-second timeouts for immediate response
    public function nautikaApiCallUltraFast($endPoint=NULL, $param=NULL)
    {
        $authParam = array('userName' => env('NAUTIKA_API_USERNAME'), 'token' => env('NAUTIKA_TOKEN'));
        $paramAll = array_merge($param, $authParam);

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])->timeout(5)->connectTimeout(3)->withoutVerifying()->post(env('NAUTIKA_API_URL') . $endPoint, $paramAll);

            $data = json_decode($response);
            return $data;

        } catch (\Exception $e) {
            $data = new \stdClass();
            $data->data = [];
            return $data;
        }
    }

    public function makApiCallUltraFast($endPoint=NULL, $param=NULL)
    {
        try {
            $response = Http::timeout(5)->connectTimeout(3)->withHeaders([
                'Mak_Authorization' => env('MAK_TOKEN'),
                'Accept' => 'application/json'
            ])
            ->withoutVerifying()
            ->post(env('MAK_API_URL') . $endPoint, $param);
            
            $data = json_decode($response);
            return $data;

        } catch (\Exception $e) {
            $data = new \stdClass();
            $data->data = [];
            return $data;
        }
    }

    public function greenOceanApiCallUltraFast($endPoint=NULL, $param=NULL)
    {
        try {
            $response = Http::timeout(5)->connectTimeout(3)->withHeaders([
                'Accept' => 'application/json'
            ])
            ->withoutVerifying()
            ->post(env('GREEN_OCEAN_API_URL') . $endPoint, $param);
            
            $data = json_decode($response);
            return $data;

        } catch (\Exception $e) {
            $data = new \stdClass();
            $data->data = [];
            return $data;
        }
    }
}

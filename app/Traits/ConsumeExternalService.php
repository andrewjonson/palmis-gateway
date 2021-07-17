<?php
namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumeExternalService
{
    /**
     * Send request to any service
     * @param $method
     * @param $requestUrl
     * @param array $formParams
     * @param array $headers
     * @return string
     */
    public function performRequest($method, $requestUrl, $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => env('API_GATEWAY_BASE_URL', 'http://10.50.30.157:8000'),
        ]);

        $headers['Authorization'] = request()->header('Authorization');
        $response = $client->request($method, $requestUrl, [
            'form_params' => $formParams,
            'headers' => $headers,
        ]);
        return json_decode($response->getBody(), true);
    }
}
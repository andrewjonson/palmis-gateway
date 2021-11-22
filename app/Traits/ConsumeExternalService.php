<?php
namespace App\Traits;

use Illuminate\Support\Facades\Http;

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
    public function performRequest($method, $requestUrl, $formParams = [])
    {
        $apiKey = config('app.api_key');
        $baseUrl = config('app.api_gateway_base_url');
        $token = request()->bearerToken();
        $response = Http::withHeaders([
            'X-Authorization' => $apiKey
        ])->$method($baseUrl.$requestUrl, $formParams);
        return $response->json();
    }
}
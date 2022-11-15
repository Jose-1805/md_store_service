<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class ApiGateway
{
    /**
     * Solicitud http a un servicio del cluster
     * @param $method
     * @param $requestUrl
     * @param array $formParams
     * @param bool $isFile
     * @return mixed
     */
    public static function performRequest($method, $requestUrl, $formParams = [], $isFile = false): mixed
    {
        $base_uri = config("services.api_gateway.base_uri");

        $func = strtolower($method);

        $request = Http::baseUrl($base_uri)->withHeaders([
            'Authorization' => config("services.api_gateway.access_secret")
        ]);

        $has_file = false;

        foreach ($formParams as $key => $value) {
            if ($value instanceof UploadedFile) {
                $has_file = true;
            }
        }

        if ($has_file) {
            foreach ($formParams as $key => $value) {
                if ($value instanceof UploadedFile) {
                    $request = $request->attach($key, $value->get(), $value->getClientOriginalName());
                }
            }
        } else {
            if ($func != 'get' && $func != 'delete') {
                $request = $request->asForm();
            }
        }

        $response = $request->$func($requestUrl, $formParams);

        $data = json_decode($response->body(), true);

        if ($data == null) {
            if ($isFile && $response->successful()) {
                return response()->streamDownload(function () use ($response) {
                    echo $response->body();
                }, '', $response->headers());
            }
            $data = ['error' => config('app.debug') && strlen($response->body()) ? $response->body() : "Error interno del servidor", 'code' => 500];
        }

        return $data;
    }
}

<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * Genera una respuesta JSON estándar
     *
     * @param string|array $data
     * @param int $code
     * @return JsonResponse
     */
    public function generateResponse($data, $code): JsonResponse
    {
        switch ($code) {
            case Response::HTTP_ACCEPTED:
            case Response::HTTP_CREATED:
            case Response::HTTP_OK:
                $final_data = is_array($data) ? (array_key_exists('data', $data) && array_key_exists('code', $data) ? $data['data'] : $data) : $data;
                return \response()->json(['data' => $final_data, 'code' => $code], $code);
                break;
            default:
                $final_data = is_array($data) ? (array_key_exists('error', $data) && array_key_exists('code', $data) ? $data['error'] : $data) : $data;
                return \response()->json(['error' => $data, 'code' => $code], $code);
                break;
        }
    }

    /**
     * Genera una respuesta con código de respuesta HTTP_OK 200
     *
     * @param string|array $data
     * @return JsonResponse
     */
    public function httpOkResponse($data = "Success."): JsonResponse
    {
        return $this->generateResponse($data, Response::HTTP_OK);
    }

    /**
     * Genera una respuesta con código de respuesta HTTP_UNAUTHORIZED 401
     *
     * @param string|array $data
     * @return JsonResponse
     */
    public function httpUnauthorizedResponse(): JsonResponse
    {
        return $this->generateResponse("Unauthorized.", Response::HTTP_UNAUTHORIZED);
    }
}

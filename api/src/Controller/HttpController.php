<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class HttpController
{
    protected $response;

    /**
     * @param array $aData
     * @return JsonResponse
     */
    public function sendOk(array $aData): JsonResponse
    {
        return
            $this
                ->getResponse()
                ->setData($aData)
                ->setStatusCode(JsonResponse::HTTP_OK)
            ;
    }

    /**
     * @return JsonResponse
     */
    protected function getResponse()
    {
        return $this->response ?? new JsonResponse();
    }
}
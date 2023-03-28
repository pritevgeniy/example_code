<?php

namespace App\Http\Api\v1\Controllers;

use App\Services\Sender\SenderService;
use Illuminate\Http\JsonResponse;

class SendController extends ApiController
{
    public function __construct(private readonly SenderInterface $senderService)
    {}

    public function send(): JsonResponse
    {
    	$dto = new NotificationDto('from', 'message');
        $result = $this->senderService->sendNotification($dto);

        return $this->response($result);
    }

    // Общий обработчик ответов
    private function response(ResultDto $result): JsonResponse
    {
        if (!$result->ok()) {
            return $this->responseSuccess([
                'success' => false,
                'message' => $result->getError()?->getMessage(),
                'errors' => $result->getError()?->getValidationErrors(),
            ]);
        }

        return $this->responseSuccess([
            'success' => true,
            ...$result->getData(),
        ]);
    }
}


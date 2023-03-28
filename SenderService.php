<?php

namespace App\Services\Sender;

use App\Services\Mapper\MapperInterface;
use App\Services\Sender\SenderInterface;
use App\Response\ResponseDto;
use Illuminate\Http\JsonResponse;

class SenderService implements SenderInterface
{
    public function __construct(
    	private readonly RequestService $requestService, // Формирует Request 
    	private readonly MapperInterface $senderMapper,	// Получает Request, и из него формирует ResponseDto
    )
    {}

    public function sendNotification(NotificationDto $dto): NotificationResponse
    {
    	$request = $this->requestService->prepare(dto->from, dto->message);
    	$response = Http::send($request);
    
        return $this->senderMapper->map($response);
    }
}


<?php

namespace App\Http\Api\v1\Controllers;

use App\Http\Api\v1\Controllers\Request\SenderRequest;
use App\Http\Api\v1\Controllers\Resources\SenderResource;
use Illuminate\Http\JsonResponse;

class SenderController extends ApiController
{
    public function __construct(private readonly SenderUseCase $senderUseCase)
    {}

    public function send(SenderRequest $request): SenderResource
    {
        return new SenderResource(
            $this->senderUseCase->sendNotification($request->getDto()),
            $request
        );
    }
}


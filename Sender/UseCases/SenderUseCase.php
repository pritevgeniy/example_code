<?php

namespace App\Services\UseCases;

class SenderUseCase
{
    public function __construct(private readonly SenderInterface $senderService)
    {
    }

    public function send(SenderDto $dto): bool
    {
        SenderJob::dispatch($dto);
        return $this->senderService->sendNotification($dto);
    }
}
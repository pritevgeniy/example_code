<?php

namespace App\Services\Jobs;

class SenderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public SenderDto $dto,
        public ?int $retry = 1,
    ) {
        $this->onQueue('high');
    }

    public function handle(
        SenderInterface $senderService,
        SenderRepository $senderRepository,
        LoggerInterface $logger
    ): void
    {
        try {
            $notificationResponse = $senderService->sendNotification($this->dto);
        } catch (\Throwable $e) {
            $senderRepository->error($this->dto);
            $logger->error("Error send notification", $e, $dto);

            return;
        }

        if ($notificationResponse->success === false) {
            if ($this->retry < 3) {
                SenderJob::dispatch($this->dto);
            } else {
                $senderRepository->error($this->dto);
            }

            return;
        }

        $senderRepository->success($this->dto);
    }
}

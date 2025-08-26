<?php
namespace App\Http\Api\v1\Controllers\Resources;

use App\Http\Resources\JsonWithoutBackslashesResource;
use Illuminate\Http\Request;

/**
 * @property bool $success
 */
class SenderResource extends JsonWithoutBackslashesResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @psalm-suppress InvalidTemplateParam
     */
    public function toArray($request): array
    {
        return [
            'status' => $this->status,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toExampleArray(): array
    {
        return [
            'data' => [
                'status' => SenderStatusEnum::Processing
            ],
        ];
    }
}

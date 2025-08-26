<?php

namespace App\Services\Enums;

enum SenderStatusEnum: string
{
    case Processing = 'processing';
    case Error  = 'error';
    case Sent = 'sent';
}

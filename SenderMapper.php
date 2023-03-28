<?php

namespace App\Services\Sender;

use App\Services\Mapper\MapperInterface;
use App\Services\Mapper\ErrorMapper;
use App\Response\ResponseDto;
use Illuminate\Http\JsonResponse;

class SenderMapper implements MapperInterface
{
    public function __construct(private readonly ErrorMapper $errorMapper) 
    {}
    
    public function map(Response $response): ResponseDto
    {
    	$responseDto = new ResponseDto();

    	if (!$response->ok()) {
            $responseDto->setError($this->errorMapper->map($response));

            return $responseDto;
        }
        
        $responseDto->setData($response->getData());
    
        return $responseDto;
    }
}


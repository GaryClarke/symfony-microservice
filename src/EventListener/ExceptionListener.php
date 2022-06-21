<?php

namespace App\EventListener;

use App\Service\ServiceException;
use App\Service\ServiceExceptionData;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof ServiceException) {
            $exceptionData = $exception->getExceptionData();
        } else {
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $exceptionData = new ServiceExceptionData($statusCode, $exception->getMessage());
        }

        $response = new JsonResponse($exceptionData->toArray());
        $event->setResponse($response);
    }
}
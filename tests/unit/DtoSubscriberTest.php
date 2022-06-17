<?php

namespace App\Tests\unit;

use App\Tests\ServiceTestCase;
use App\DTO\LowestPriceEnquiry;
use App\Service\ServiceException;
use App\Event\AfterDtoCreatedEvent;
use App\EventSubscriber\DtoSubscriber;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DtoSubscriberTest extends ServiceTestCase
{
    public function testEventSubscription(): void
    {
        $this->assertArrayHasKey(AfterDtoCreatedEvent::NAME, DtoSubscriber::getSubscribedEvents());
    }

    public function testValidateDto(): void
    {
        $dto = new LowestPriceEnquiry();
        $dto->setQuantity(-5);
        $event = new AfterDtoCreatedEvent($dto);
        $dispatcher = $this->container->get(EventDispatcherInterface::class);

        $this->expectException(ServiceException::class);
        $this->expectExceptionMessage('ConstraintViolationList');

        $dispatcher->dispatch($event, $event::NAME);
    }
}
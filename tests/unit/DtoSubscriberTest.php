<?php

namespace App\Tests\unit;

use App\Tests\ServiceTestCase;
use App\DTO\LowestPriceEnquiry;
use App\Service\ServiceException;
use App\Event\AfterDtoCreatedEvent;
use App\EventSubscriber\DtoSubscriber;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DtoSubscriberTest extends ServiceTestCase
{
    public function testEventSubscription(): void
    {
        $this->assertArrayHasKey(AfterDtoCreatedEvent::NAME, DtoSubscriber::getSubscribedEvents());
    }

    public function testValidateDto(): void
    {
        $validator = $this->createMock(ValidatorInterface::class);
        $validator->expects($this->once())
            ->method('validate')
            ->willReturn(new ConstraintViolationList([
                new ConstraintViolation('', '', [], null, '', null)
            ]));

        $dto = new LowestPriceEnquiry();
        $dto->setQuantity(-5);
        $subscriber = new DtoSubscriber($validator);
        $event = new AfterDtoCreatedEvent($dto);

        $this->expectException(ServiceException::class);
        $this->expectExceptionMessage('Validation failed');

        $subscriber->validateDto($event);
    }
}
<?php

namespace App\Tests\unit;

use App\DTO\LowestPriceEnquiry;
use App\Event\AfterDtoCreatedEvent;
use App\Tests\ServiceTestCase;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;

use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class DtoSubscriberTest extends ServiceTestCase
{
    /** @test */
    public function a_dto_is_validated_after_it_has_been_created(): void
    {
        // Given
        $dto = new LowestPriceEnquiry();
        $dto->setQuantity(-5);

        $event = new AfterDtoCreatedEvent($dto);

        /** @var EventDispatcherInterface $eventDispatcher */
        $eventDispatcher = $this->container->get('debug.event_dispatcher');

        // Expect
        $this->expectException(ValidationFailedException::class);
        $this->expectExceptionMessage('This value should be positive.');

        // When
        $eventDispatcher->dispatch($event);
    }









}
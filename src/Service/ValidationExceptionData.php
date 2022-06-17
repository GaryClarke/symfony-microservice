<?php

namespace App\Service;

use Symfony\Component\Validator\ConstraintViolationList;

class ValidationExceptionData extends ServiceExceptionData
{
    private ConstraintViolationList $violations;

    public function __construct(int $statusCode, string $type, ConstraintViolationList $violations)
    {
        parent::__construct($statusCode, $type);

        $this->violations = $violations;
    }

    public function toArray(): array
    {
        return [
            'type'        => 'ConstraintViolationList',
            'violations'  => $this->getViolationsArray()
        ];
    }

    public function getViolationsArray():array
    {
        $violations = [];

        foreach ($this->violations as $violation) {

            $violations[] = [
                'propertyPath' => $violation->getPropertyPath(),
                'message'      => $violation->getMessage()
            ];
        }

        return $violations;
    }
}
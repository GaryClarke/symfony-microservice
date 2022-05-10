<?php

namespace App\Filter\Modifier\Factory;

use App\Filter\Modifier\PriceModifierInterface;

interface PriceModifierFactoryInterface
{
    public function create(string $modifierType): PriceModifierInterface;
}
<?php

namespace App\Filter\Modifier\Factory;

use App\Entity\Promotion;
use App\Filter\Modifier\PriceModifierInterface;

interface PriceModifierFactoryInterface
{
    const PRICE_MODIFIER_NAMESPACE = "App\Filter\Modifier\\";

    public function create(Promotion $promotion): PriceModifierInterface;
}
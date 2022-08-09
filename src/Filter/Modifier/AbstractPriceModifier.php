<?php

namespace App\Filter\Modifier;

use App\Entity\Promotion;
use App\DTO\PromotionEnquiryInterface;

abstract class AbstractPriceModifier implements PriceModifierInterface
{
    abstract function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquiry): int;

    public function canApply(string $promotionType): bool
    {
        return static::PROMOTION_TYPE === $promotionType;
    }
}
<?php

namespace App\Filter\Modifier;

use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;

class EvenItemsMultiplier extends AbstractPriceModifier
{
    protected const PROMOTION_TYPE = Promotion::PROMOTION_TYPE_EVEN_ITEMS;

    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquiry): int
    {
        if ($quantity < 2) {

            return $price * $quantity;
        }

        $oddCount = $quantity % 2;

        $evenCount = $quantity - $oddCount;

        return (($evenCount * $price) * $promotion->getAdjustment()) + ($oddCount * $price);
    }
}
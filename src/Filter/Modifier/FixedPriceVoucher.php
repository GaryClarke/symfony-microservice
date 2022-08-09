<?php

namespace App\Filter\Modifier;

use App\Entity\Promotion;
use App\DTO\PromotionEnquiryInterface;

class FixedPriceVoucher extends AbstractPriceModifier
{
    protected const PROMOTION_TYPE = Promotion::PROMOTION_TYPE_FIXED_PRICE;

    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquiry): int
    {
        if (!($enquiry->getVoucherCode() === $promotion->getCriteria()['code'])) {

            return $price * $quantity;
        }

        return $promotion->getAdjustment() * $quantity;
    }
}
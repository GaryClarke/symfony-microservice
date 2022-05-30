<?php

namespace App\Filter\Modifier;

use App\Entity\Promotion;
use App\DTO\PromotionEnquiryInterface;

class FixedPriceVoucher implements PriceModifierInterface
{
    public function __construct(private string $code)
    {
    }

    public function modify(int $unitPrice, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquiry): int
    {
        if (!($enquiry->getVoucherCode() === $this->code)) {

            return $unitPrice * $quantity;
        }

        return $promotion->getAdjustment() * $quantity;
    }
}
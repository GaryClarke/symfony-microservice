<?php

namespace App\Filter\Modifier;

use App\Entity\Promotion;
use App\DTO\PromotionEnquiryInterface;

class DateRangeMultiplier implements PriceModifierInterface
{
    private \DateTimeInterface $from;
    private \DateTimeInterface $to;

    public function __construct(string $from, string $to)
    {
        $this->from = date_create_immutable($from);
        $this->to = date_create_immutable($to);
    }

    public function modify(int $unitPrice, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquiry): int
    {
        $requestDate = date_create($enquiry->getRequestDate());

        if (!($requestDate >= $this->from && $requestDate < $this->to)) {

            return $unitPrice * $quantity;
        }

        // (price * quantity) * promotion->adjustment
        return ($unitPrice * $quantity) * $promotion->getAdjustment();
    }
}
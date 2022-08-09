<?php

namespace App\Filter\Modifier;

use App\Entity\Promotion;
use App\DTO\PromotionEnquiryInterface;

class DateRangeMultiplier extends AbstractPriceModifier
{
    protected const PROMOTION_TYPE = Promotion::PROMOTION_TYPE_DATE_RANGE;

    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquiry): int
    {
        $requestDate = date_create($enquiry->getRequestDate());
        $from = date_create($promotion->getCriteria()['from']);
        $to = date_create($promotion->getCriteria()['to']);

        if (!($requestDate >= $from && $requestDate < $to)) {

            return $price * $quantity;
        }

        return ($price * $quantity) * $promotion->getAdjustment();
    }
}
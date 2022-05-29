<?php

namespace App\DTO;

interface PriceEnquiryInterface extends PromotionEnquiryInterface
{
    public function setUnitPrice(int $price);

    public function setDiscountedPrice(int $discountedPrice);

    public function getQuantity(): ?int;
}
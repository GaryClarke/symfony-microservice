<?php

namespace App\DTO;

interface PriceEnquiryInterface extends PromotionEnquiryInterface
{
    public function setPrice(int $price);

    public function setDiscountedPrice(int $discountedPrice);

    public function getQuantity(): ?int;
}
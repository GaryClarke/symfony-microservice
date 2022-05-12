<?php

namespace App\Filter;

use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;
use App\Filter\Modifier\Factory\PriceModifierFactoryInterface;

class LowestPriceFilter implements PromotionsFilterInterface
{
    public function __construct(private PriceModifierFactoryInterface $priceModifierFactory)
    {
    }


    public function apply(PromotionEnquiryInterface $enquiry, Promotion ...$promotions)
    : PromotionEnquiryInterface
    {
        $price = $enquiry->getProduct()->getPrice();
        $enquiry->setPrice($price);
        $quantity = $enquiry->getQuantity();
        $lowestPrice = $quantity * $price;

        foreach ($promotions as $promotion) {

            $priceModifier = $this->priceModifierFactory->create($promotion->getType());

            $modifiedPrice = $priceModifier->modify($price, $quantity, $promotion, $enquiry);

            if($modifiedPrice < $lowestPrice) {

                $enquiry->setDiscountedPrice($modifiedPrice);
                $enquiry->setPromotionId($promotion->getId());
                $enquiry->setPromotionName($promotion->getName());

                $lowestPrice = $modifiedPrice;
            }
        }

        return $enquiry;
    }
}
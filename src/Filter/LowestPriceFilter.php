<?php

namespace App\Filter;

use App\Entity\Promotion;
use App\DTO\PriceEnquiryInterface;
use App\Filter\Modifier\Factory\PriceModifierFactoryInterface;
use App\Filter\Modifier\PriceModifierInterface;
use Symfony\Component\VarExporter\Exception\ClassNotFoundException;

class LowestPriceFilter implements PriceFilterInterface
{
    /**
     * @param PriceEnquiryInterface[] $priceModifiers
     */
    public function __construct(private iterable $priceModifiers)
    {
    }


    public function apply(PriceEnquiryInterface $enquiry, Promotion ...$promotions)
    : PriceEnquiryInterface
    {
        $price = $enquiry->getProduct()->getPrice();
        $enquiry->setPrice($price);
        $quantity = $enquiry->getQuantity();
        $lowestPrice = $quantity * $price;

        foreach ($promotions as $promotion) {

            $modifiedPrice = null;
            /** @var PriceModifierInterface $priceModifier */
            foreach ($this->priceModifiers as $priceModifier) {
                if ($priceModifier->canApply($promotion->getType())) {
                    $modifiedPrice = $priceModifier->modify($price, $quantity, $promotion, $enquiry);
                    break;
                }

            }

            if (null === $modifiedPrice) {
                throw new ClassNotFoundException("Price modifier not found for promotion with type {$promotion->getType()}");
            }

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
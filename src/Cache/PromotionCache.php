<?php

namespace App\Cache;

use App\Entity\Product;
use App\Entity\Promotion;
use App\Repository\PromotionRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class PromotionCache
{
    public function __construct(private CacheInterface $cache, private PromotionRepository $repository)
    {
    }

    public function findValidForProduct(Product $product, string $requestDate): ?array
    {
        $key = sprintf("valid-for-product-%d", $product->getId());

        return $this->cache->get($key, function(ItemInterface $item) use ($product, $requestDate) {

            $item->expiresAfter(5);

            return $this->repository->findValidForProduct(
                $product,
                date_create_immutable($requestDate)
            );
        });
    }
}
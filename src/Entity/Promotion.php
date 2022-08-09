<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{
    public const PROMOTION_TYPE_FIXED_PRICE = 'fixed_price_voucher';
    public const PROMOTION_TYPE_DATE_RANGE = 'date_range_multiplier';
    public const PROMOTION_TYPE_EVEN_ITEMS = 'even_items_multiplier';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\Column(type: 'float')]
    private $adjustment;

    #[ORM\Column(type: 'json')]
    private $criteria = [];

    #[ORM\OneToMany(mappedBy: 'promotion', targetEntity: ProductPromotion::class)]
    private $productPromotions;

    public function __construct()
    {
        $this->productPromotions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAdjustment(): ?float
    {
        return $this->adjustment;
    }

    public function setAdjustment(float $adjustment): self
    {
        $this->adjustment = $adjustment;

        return $this;
    }

    public function getCriteria(): ?array
    {
        return $this->criteria;
    }

    public function setCriteria(array $criteria): self
    {
        $this->criteria = $criteria;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getProductPromotions(): ArrayCollection
    {
        return $this->productPromotions;
    }
}

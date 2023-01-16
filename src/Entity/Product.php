<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Error;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $itemReference = null;

    #[ORM\Column(length: 10)]
    private ?string $itemCategory = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemReference(): ?string
    {
        return $this->itemReference;
    }

    public function setItemReference(string $itemReference): self
    {
        if (in_array($this->getItemCategory(), ['', null])) {
            throw new Error('itemCategory property must be defined to set the itemReference property.');
        }
        $this->itemReference = substr($this->getItemCategory(), 0, 3) . $itemReference;

        return $this;
    }

    public function getItemCategory(): ?string
    {
        return $this->itemCategory;
    }

    public function setItemCategory(string $itemCategory): self
    {
        $this->itemCategory = $itemCategory;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min:2, max:50)]
    #[Assert\NotBlank()]
    private ?string $productName = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $productDesc = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    #[Assert\NotNull()]
    #[Assert\Positive()]
    #[Assert\LessThan(999)]
    private ?string $productPrice = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[Assert\NotBlank()]
    private ?category $categoryId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getProductDesc(): ?string
    {
        return $this->productDesc;
    }

    public function setProductDesc(string $productDesc): self
    {
        $this->productDesc = $productDesc;

        return $this;
    }

    public function getProductPrice(): ?string
    {
        return $this->productPrice;
    }

    public function setProductPrice(string $productPrice): self
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    public function getCategoryId(): ?category
    {
        return $this->categoryId;
    }

    public function setCategoryId(?category $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }
}

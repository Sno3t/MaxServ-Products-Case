<?php

namespace MaxServ\App\DTO;

class ProductDTO
{

    /**
     * @param int $externalId
     * @param string $title
     * @param string $description
     * @param float $price
     * @param float $discountPercentage
     * @param string|null $brand
     * @param string $category
     * @param string $thumbnail
     */
    public function __construct(
        private int    $externalId,
        private string $title,
        private string $description,
        private float  $price,
        private float  $discountPercentage,
        private ?string $brand,
        private string $category,
        private string $thumbnail
    )
    {
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            externalId: $data['id'],
            title: $data['title'],
            description: $data['description'],
            price: $data['price'],
            discountPercentage: ($data['discount_percentage']),
            brand: $data['brand'] ?? null,
            category: $data['category'],
            thumbnail: $data['thumbnail']
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'externalId' => $this->externalId,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'discountPercentage' => $this->discountPercentage,
            'brand' => $this->brand,
            'category' => $this->category,
            'thumbnail' => $this->thumbnail
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->externalId;
    }

    /**
     * @return int
     */
    public function getExternalId(): int
    {
        return $this->externalId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * @return float
     */
    public function getFinalPrice(): float
    {
        return $this->price * (1 - $this->discountPercentage / 100);
    }
}
